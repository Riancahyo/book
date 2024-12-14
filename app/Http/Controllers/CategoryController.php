<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori termasuk kategori yang dihapus (soft delete)
        $categories = Category::withoutTrashed()->paginate(10);
    return view('categories.index', compact('categories'));
    }

    public function userCategories()
    {
        // Mengambil kategori yang tidak diarsipkan untuk user
        $categories = Category::where('is_archived', false)->get();
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
        $category = Category::withTrashed()->findOrFail($id);
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
        // Soft delete kategori berdasarkan ID
        $category = Category::findOrFail($id);
        $category->delete();

        // Redirect ke halaman daftar kategori dengan pesan sukses
        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }

    public function restore($id)
    {
        // Memulihkan kategori yang dihapus (soft delete)
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dipulihkan!');
    }

    public function archive($id)
    {
        // Mengarsipkan kategori
        $category = Category::findOrFail($id);
        $category->is_archived = true;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diarsipkan!');
    }

    public function unarchive($id)
    {
        // Membatalkan arsip kategori
        $category = Category::findOrFail($id);
        $category->is_archived = false;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dikembalikan dari arsip!');
    }
}
