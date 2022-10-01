<?php

namespace App\Services;

use App\Models\Institution;
use App\Models\User;
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
        $sanitazeData = $this->sanitazeData($data);

        $user = User::create($sanitazeData);
        return $user;
    }

    /**
     * updated user before execute sanitaze request
     *
     * @param array $data
     * @param User $user
     * @return User
     */
    public function update(array $data, User $user): User
    {
        $sanitazeData = $this->sanitazeData($data, $user);
        $user->update($sanitazeData);
        if (!$user) {
            return $this->badRequest(['erro' => 'Error when trying to change user.']);
        }
        return  $user;
    }

    /**
     * sanitaze request before create or update
     *
     * @param array $data
     * @return array
     */
    private function sanitazeData(array $data, ?User $user = null): array
    {
        /* dd($user, $data, $data['institution_id']); */
        if(!$user){
            $institution = Institution::find($data['institution_id']);
        }
       return[
        ...$data,
        'username' => $user === null ? generateUsername($institution->name) : $data['username'],
        'password' => Hash::make(data_get($data, 'password')),
       ];
    }
}
