<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use App\Traits\ApiResponse;
use Facades\App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;
    /**
     * list all with paginate
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listAll(Request $request): JsonResponse
    {
        $users = UserService::listAll($request->all());
        return $this->ok(new UserResourceCollection($users));
    }

    /**
     * create a new users
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function create(StoreUserRequest $request): JsonResponse
    {
        $user = UserService::create($request->validated());
        return $this->ok(UserResource::make($user));
    }

    /**
     * find user for id
     *
     * @param User $user
     * @return JsonResponse
     */
    public function find(User $user): JsonResponse
    {
        return $this->ok(UserResource::make($user));
    }

    /**
     * Update user
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        UserService::update($request->validated(), $user);
        return $this->ok(['message' => 'Usuário atualizado com sucesso!']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->ok(["message" => "Usuário deletado com sucesso"]);
    }
}
