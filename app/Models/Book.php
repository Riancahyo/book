<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Definisikan atribut yang bisa diisi secara massal
    protected $fillable = [
        'id',
        'title',
        'author',
        'description',
        'status',
        'user_id',
        'category_id',
        'image',
        'gdrive_link',
    ];

    /**
     * Relasi ke model Category
     * Buku terkait dengan satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke model User
     * Buku dapat terkait dengan satu pengguna (contoh: peminjam).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter berdasarkan status buku
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
