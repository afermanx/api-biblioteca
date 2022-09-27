<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiException;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    use ApiResponse;

    /**
     * list all user with paramters of paginate
     *
     * @param array $data
     * @return LengthAwarePaginator
     */
    public function listAll(array $data): LengthAwarePaginator
    {
        $perPage = data_get($data, 'perPage') ?? 10;
        return User::paginate($perPage);
    }

    /**
     * create a new user
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {

        return User::create([
            ...$data,
            'username' => $this->generateRaLogin(),
            'password' => Hash::make(data_get($data, 'password')),
        ]);
    }

    public function update(array $data, User $user)
    {
        $isSaved = $user->update([
            ...$data,
            'password' => Hash::make(data_get($data, 'password')),
        ]);

        if (!$isSaved || $data === []) {
            return $this->badRequest(['erro' => 'Error when trying to change user.']);
        }
        return $this->ok(['message' => 'User changed successfully']);
    }

   /**
    * Generate RA for used login
    *
    * @return string
    */
    private function generateRaLogin(): string
    {
        $raAuth = 'RA' . rand();
        return  $raAuth;
    }
}
