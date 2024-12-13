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
        $books = Book::with('category', 'user')->paginate(10); // Ambil semua buku dengan relasi
        $categories = Category::all(); // Ambil semua kategori
        return view('books.index', compact('books', 'categories')); // Kirim data ke view
    }

    public function userBooks()
    {
        $books = Book::with('category')->where('status', 'Tersedia')->get(); // Hanya buku yang tersedia
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

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete(); // Menghapus buku
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    // Menampilkan buku berdasarkan kategori
    public function booksByCategory(Category $category)
    {
        $books = $category->books()->paginate(10); // Ambil semua buku dalam kategori dengan paginasi
        return view('books.index', compact('books', 'category')); // Kirim data ke view
    }
}
