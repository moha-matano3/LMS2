<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'due_date',
        'extension_status',
        'reservation_status',
    ];

    public function books()
    {
        return $this->belongsTo(books::class, 'books_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    public function isPastDue()
    {
        return $this->due_date < now();
    }
}
