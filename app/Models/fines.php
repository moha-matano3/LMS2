<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fines extends Model
{
    use HasFactory;

    protected $fillable = ['borrows_id', 'amount', 'is_paid'];

    public function fines()
    {
        return $this->belongsTo(Borrow::class);
    }
}
