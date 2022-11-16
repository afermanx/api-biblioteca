<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'status',
        'place',
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

    /**
     * The library that owns the Book
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The rents that belong to the Book
     *
     * @return BelongsToMany
     */
    public function rent(): BelongsTo
    {
        return $this->belongsTo(Rent::class);
    }
}
