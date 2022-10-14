<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BookResource;
use Facades\App\Services\BookService;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResourceCollection;

class BookController extends Controller
{
    use ApiResponse;

    /**
     * This function returns a list of all users
     *
     * @param Request request The request object
     *
     * @return JsonResponse A collection of books
     */
    public function listAll(Request $request): JsonResponse
    {
        $book = BookService::listAll($request->all());
        return $this->ok(new BookResourceCollection($book));
    }


    public function create(StoreBookRequest $request): JsonResponse
    {
        $user = BookService::create($request->validated());
        return $this->ok(BookResource::make($user));
    }
}
