<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',
        'book_img',
        'desc',
        'author_name',
        'author_img',
        'price',
        'quantity',
        'shelf_place',
        'publisher_name',
        'year',
        'pg_rating',
        'categories_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function borrows()
{
    return $this->hasMany(Borrow::class);
}
}
