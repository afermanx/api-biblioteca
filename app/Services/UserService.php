<?php

namespace App\Services;
use App\Models\User;
use App\Traits\ApiException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    use ApiException;

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
            'institution_id' => data_get($data, 'institution_id'),
            'name' => data_get($data, 'name'),
            'cpf' => data_get($data, 'cpf'),
            'email' => data_get($data, 'email'),
            'password' => Hash::make(data_get($data, 'password')),
            'is_admin' => data_get($data, 'is_admin'),
        ]);
    }

}
