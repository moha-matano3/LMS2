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
        'publication',
        'publisher_name',
        'year',
        'editor',
        'pg_rating',
        'categories_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }
}
