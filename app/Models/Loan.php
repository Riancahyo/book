<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'due_date',
        'status',
    ];

    protected $dates = ['loan_date', 'due_date'];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
