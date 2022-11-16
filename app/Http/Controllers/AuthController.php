<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Traits\ApiResponse;
use Facades\App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    /**
     * log in and generate token through a service
     *
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $token_key = AuthService::login($request->validated());

        return $this->ok([
            'token_key' => $token_key
        ]);
    }

    /**
     * return data of user authentication
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return $this->ok(auth()->user());
    }

    /**
     * logout and token revoked to auth user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        AuthService::logout($request->user());
        return $this->ok(['message' => 'Logout and revoked token.']);
    }
}
