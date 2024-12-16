<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            // 'title' => 'required|string|max:255', // Judul wajib diisi
            // 'author' => 'required|string|max:225', // Penulis wajib diisi
            // 'description' => 'nullable|string', // Deskripsi opsional
            // 'status' => 'required|in:Tersedia,Tidak Tersedia', // Status harus valid (Tersedia/Tidak Tersedia)
            // 'category_id' => 'nullable|exists:categories,id', // Kategori harus ada di tabel kategori
            // 'image' => 'nullable|image|max:2048', // Gambar opsional, harus file gambar dengan maksimal 2MB
            // 'gdrive_link' => 'nullable|url|max:255', // Link Google Drive opsional dan valid
        ];
    }

    public function messages()
    {
        return [
            // 'title.required' => 'Judul buku harus diisi.',
            // 'author.required' => 'Penulis buku harus diisi.',
            // 'status.required' => 'Status buku harus diisi.',
            // 'status.in' => 'Status harus salah satu dari: Tersedia, Tidak Tersedia.',
            // 'category_id.exists' => 'Kategori yang dipilih tidak valid.',
            // 'image.image' => 'File harus berupa gambar.',
            // 'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            // 'gdrive_link.url' => 'Link Google Drive harus berupa URL yang valid.',
        ];
    }
}
