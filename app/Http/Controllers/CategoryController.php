<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function userCategories()
    {
        $categories = Category::all();
        return view('user.categories', compact('categories'));
    }


    public function create()
    {
        // Menampilkan form untuk membuat kategori baru
        return view('categories.create');
    }

    public function store(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'name' => 'required|string|max:255',  // Kolom name wajib diisi
            'description' => 'nullable|string',   // Kolom description bersifat opsional
        ]);

        // Membuat kategori baru menggunakan data yang sudah divalidasi
        Category::create($validated);

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Menampilkan form edit untuk kategori yang dipilih
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function show($id)
    {
        // Menampilkan detail kategori yang dipilih
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Mengambil kategori berdasarkan ID
        $category = Category::findOrFail($id);
        
        // Validasi input dari pengguna untuk update
        $validated = $request->validate([
            'name' => 'required|string|max:255',  // Kolom name wajib diisi
            'description' => 'nullable|string',   // Kolom description bersifat opsional
        ]);

        // Memperbarui data kategori dengan data yang sudah divalidasi
        $category->update($validated);

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Menghapus kategori berdasarkan ID
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
