<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Menampilkan semua buku aktif (tidak diarsipkan)
    public function index()
    {
        $books = Book::with(['category', 'user'])->where('is_archived', false)->paginate(10);
        $categories = Category::all();
        return view('books.index', compact('books', 'categories'));
    }

    // Menampilkan buku yang tersedia untuk user
    public function userBooks()
    {
        $books = Book::with('category')->where('status', 'Tersedia')->where('is_archived', false)->get();
        return view('user.books', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:225',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Tidak_Tersedia',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
            'gdrive_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $request->merge(['image' => $imagePath]);
        }

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan detail buku
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Menampilkan form edit buku
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // Memperbarui buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:225',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Tidak_Tersedia',
            'category_id' => 'nullable|exists:categories,id',
            'user_id' => 'nullable|exists:users,id',
            'gdrive_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $book->image = $imagePath;
        }

        $book->update($request->except('image'));

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku secara soft delete
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    // Menampilkan buku yang telah dihapus (soft delete)
    public function trashed()
    {
        // Mengambil buku yang sudah dihapus (soft delete)
        $books = Book::onlyTrashed()->paginate(10);

        // Mengarahkan ke view 'trashed'
        return view('books.trashed', compact('books'));
    }

    // Mengembalikan buku dari soft delete
    public function restore($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();
        return redirect()->route('books.trashed')->with('success', 'Buku berhasil dikembalikan.');
    }

    // Menghapus buku secara permanen
    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->forceDelete();
        return redirect()->route('books.trashed')->with('success', 'Buku berhasil dihapus permanen.');
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
}