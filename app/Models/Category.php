<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Relasi one-to-many dengan Book (Jika diperlukan)
    public function books()
    {
        return $this->hasMany(Book::class); // Satu kategori memiliki banyak buku
    }
}
