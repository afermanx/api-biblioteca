<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Institution;
use App\Traits\ApiException;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    use ApiException;

    /**
     * > This function returns a paginated list of all books
     *
     * @param array data The data that was passed to the controller.
     *
     * @return LengthAwarePaginator A LengthAwarePaginator object.
     */
    public function listAll(array $data): LengthAwarePaginator
    {
        $perPage = $data['perPage'] ?? 10;
        return Book::paginate($perPage);
    }

   /**
    * It takes an array of data, sanitizes it, and then creates a new book with the sanitized data
    *
    * @param array data The data to be sanitized.
    *
    * @return Book A new book object
    */
    public function create(array $data): Book
    {
        $sanitazeData = $this->sanitazeData($data);
        $book = Book::create($sanitazeData);
        $book = Book::find($book->id);
        return $book;
    }


  /**
   * It updates the book.
   *
   * @param array data The data that will be used to update the book.
   * @param Book book The book object that will be updated.
   *
   * @return Book The book that was updated.
   */
    public function update(array $data, Book $book): Book
    {
        $sanitazeData = $this->sanitazeData($data, $book);
        $book->update($sanitazeData);
        if (!$book) {
            return $this->badRequestException(['erro' => 'Error when trying to change book.']);
        }
        return  $book;
    }

    /**
     * sanitaze request before create or update
     *
     * @param array $data
     * @return array
     */
    private function sanitazeData(array $data, ?Book $book = null): array
    {
        return[
         ...$data
        ];
    }
}