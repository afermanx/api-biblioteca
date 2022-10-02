<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "inep",
        "admin_dependency",
        "phases",
        "modalities"
    ];

    /**
     * > The user() function returns a relationship between the User model and the Profile model
     *
     * @return A user object
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
