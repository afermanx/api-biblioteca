<?php

namespace App\Http\Controllers;
use Facades\App\Services\AuthService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginUserRequest;


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
