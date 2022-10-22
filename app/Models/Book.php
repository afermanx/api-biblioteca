<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'avatar',
        'name',
        'description',
        'classification',
        'author',
        'publisher',
        'shelf',
        'amount',
        'status'
    ];

    /**
     * The categories that belong to the Book
     *
    *
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
