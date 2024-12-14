<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'due_date',
        'status',
        'is_archived',
    ];

    protected $dates = ['loan_date', 'due_date', 'delete_at'];

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
