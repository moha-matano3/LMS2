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
<<<<<<< HEAD
        'publisher_name',
        'year',
=======
        'publication',
        'publisher_name',
        'year',
        'editor',
>>>>>>> 77892e75226f90fd3341628a54bbd19a90a7c50f
        'pg_rating',
        'categories_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
