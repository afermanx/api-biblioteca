<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookResourceCollection;
use App\Models\Book;
use App\Models\User;
use App\Traits\ApiResponse;
use Facades\App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    /**
     * Return a 200 OK response with the given user resource.
     *
     * @param User user The model that the controller relates to.
     *
     * @return JsonResponse A JSON response with the user's information.
     */
    public function show(Book $book): JsonResponse
    {
        return $this->ok(new BookResource($book));
    }


    /**
     * > It creates a book and returns a JSON response
     *
     * @param StoreBookRequest request The request object.
     *
     * @return JsonResponse A JsonResponse object
     */
    public function create(StoreBookRequest $request): JsonResponse
    {
        $book = BookService::create($request->validated());
        return $this->ok(BookResource::make($book));
    }


   /**
    * > Update a book
    *
    * @param Request request The request object
    * @param Book book The Book model instance that we're updating.
    *
    * @return JsonResponse A JsonResponse with the updated book.
    */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $book = BookService::update($request->validated(), $book);
        return $this->ok(BookResource::make($book));
    }

    /**
     * > Delete a book
     *
     * @param Request $request
     * @param Book $book
     * @return JsonResponse
     */
    public function sendAvatar(Request $request, Book $book): JsonResponse
    {

        $book = BookService::sendAvatar($request->file('avatar'), $book);
        return $this->ok(['message' => 'Imagem enviada com sucesso.']);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();
        return $this->ok(['message' => 'Livro deletado com sucesso']);
    }
}
