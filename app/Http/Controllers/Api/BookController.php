<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize(ability: "view posts");
        $data = Book::paginate(5); // Mendapatkan data buku dengan paginasi
        return response()->json([
            "status" => "berhasil",
            "data" => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:225',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'category_id' => 'nullable|exists:categories,id',
            'gdrive_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('img', 'public');
        }

        $book = Book::create($validated);

        return new BookResource(true, "Buku berhasil tambahkan", $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'berhasil',
            'data' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:225',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'category_id' => 'nullable|exists:categories,id',
            'gdrive_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('img', 'public');
        }

        $book->update($validated);

        return response()->json([
            'status' => 'berhasil',
            'message' => 'Buku berhasil diperbarui',
            'data' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $book->delete();

        return response()->json([
            'status' => 'berhasil',
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
