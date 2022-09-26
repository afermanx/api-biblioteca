<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Events\TokenAuthenticated;

class AuthService
{
    use ApiResponse;

    /**
     * login and token generation
     *
     * @param array $data
     * @return string
     */
    public function login(array $data): string
    {

        if (!Auth::attempt($data)) {
            return $this->badRequest(['message' => 'Credentials not match.']);
        }

        return auth()->user()->createToken('api-biblioteca-' . auth()->user()->id)->plainTextToken;
    }

    /**
     * get the token of the logged in user to delete only the token used for the login and then log out
     *
     * @param User $user
     * @return boolean
     */
    public function logout(User $user): bool
    {
        if (!$user) {
            return $this->ok(['message' => 'User not found.']);
        }

        return $user->currentAccessToken()->delete();
    }
}
