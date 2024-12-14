<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::with('category', 'user')->where('is_archived', false)->paginate(10); // Buku yang aktif
        $categories = Category::all(); // Ambil semua kategori
        return view('books.index', compact('books', 'categories')); // Kirim data ke view
    }

    public function userBooks()
    {
        $books = Book::with('category')->where('status', 'Tersedia')->where('is_archived', false)->get(); // Buku yang tersedia dan tidak diarsipkan
        return view('user.books', compact('books'));
    }

    // Menampilkan form untuk menambahkan buku baru
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('books.create', compact('categories')); // Kirim kategori ke view
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:225',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Tidak_Tersedia',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
            'gdrive_link' => 'nullable|url', // Validasi URL untuk Google Drive
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi file image
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $request->merge(['image' => $imagePath]);
        }

        Book::create($request->all());

        // Redirect ke index buku dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan detail buku
    public function show(Book $book)
    {
        return view('books.show', compact('book')); // Kirim data buku ke view
    }

    // Menampilkan form untuk mengedit buku
    public function edit(Book $book)
    {
        $categories = Category::all(); // Ambil semua kategori
        return view('books.edit', compact('book', 'categories')); // Kirim data ke view
    }

    // Memperbarui buku
    public function update(Request $request, Book $book)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:225',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Tidak_Tersedia',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
            'gdrive_link' => 'nullable|url', // Validasi URL untuk Google Drive
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi file image
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $book->image = $imagePath;
        }

        $book->update($request->except('image'));

        // Redirect ke index buku dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku (Soft Delete)
    public function destroy(Book $book)
    {
        $book->delete(); // Soft delete buku
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    // Menampilkan buku berdasarkan kategori
    public function booksByCategory(Category $category)
    {
        $books = $category->books()->where('is_archived', false)->paginate(10); // Buku dalam kategori yang tidak diarsipkan
        return view('books.index', compact('books', 'category')); // Kirim data ke view
    }

    // Mengarsipkan buku
    public function archive($id)
    {
        $book = Book::findOrFail($id);
        $book->is_archived = true;
        $book->save();

        return redirect()->back()->with('success', 'Buku berhasil diarsipkan.');
    }

    // Mengembalikan buku dari arsip
    public function unarchive($id)
    {
        $book = Book::findOrFail($id);
        $book->is_archived = false;
        $book->save();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan dari arsip.');
    }

    // Menampilkan buku yang dihapus (Soft Delete)
    public function trashed()
    {
        $books = Book::onlyTrashed()->paginate(10); // Buku yang dihapus saja
        return view('books.trashed', compact('books'));
    }

    // Mengembalikan buku yang dihapus (Restore)
    public function restore($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dikembalikan.');
    }

    // Menghapus permanen buku
    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->forceDelete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus permanen.');
    }
}
