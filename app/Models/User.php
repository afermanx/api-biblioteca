<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'institution_id',
        'name',
        'username',
        'email',
        'type',
        'is_admin',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The `institution()` function returns a relationship between the `User` model and the
     * `Institution` model
     *
     * @return The institution that is associated with the user.
     */
    public function institution()
    {
        return $this->hasOne(Institution::class);
    }

    /**
     * The `books()` function returns a relationship between the `User` model and the
     *
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    /**
     * The `rents()` function returns a relationship between the `User` model and the
     *
     * @return HasMany
     */
    public function rents(): HasMany
    {
        return $this->hasMany(Rent::class);
    }
}
