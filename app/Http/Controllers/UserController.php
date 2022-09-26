<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use Facades\App\Services\UserService;
use App\Traits\ApiResponse;
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
        return $this->ok(new UserResource($user));
    }
}
