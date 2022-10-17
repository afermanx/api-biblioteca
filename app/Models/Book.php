<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'name',
        'description',
        'classification',
        'author',
        'publisher',
        'avatar',
        'amount',
        'status'
    ];
}
