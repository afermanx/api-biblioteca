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
        'name',
        'description',
        'classification',
        'author',
        'publisher',
        'avatar',
        'amount',
        'status'
    ];

    /**
     * The categories that belong to the Book
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
