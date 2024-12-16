<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'is_archived'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'is_archived' => 'boolean',
    ];

    // Relasi one-to-many dengan Book (Jika diperlukan)
    public function books()
    {
        return $this->hasMany(Book::class); // Satu kategori memiliki banyak buku
    }
}
