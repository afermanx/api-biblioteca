<?php

namespace App\Services;

use App\Models\Book;
use App\Traits\ApiException;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $perPage = $data['perPage'] ?? 5;
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
        if ($sanitazeData['category']) {
            $book->categories()->attach($sanitazeData['category']);
        }
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
        tap($book)->update($sanitazeData);
        if (!$book) {
            return $this->badRequestException(['erro' => 'Error when trying to change book.']);
        }
        return  $book;
    }

    /**
     * send avatar to storage
     */
    public function sendAvatar(UploadedFile $file, Book $book): string
    {
        $avatar = $this->sanitazeAvatar($file);
        $book->update(['avatar' => $avatar]);
        return '$name';
    }

    /**
     * sanitaze request before create or update
     *
     * @param array $data
     * @return array
     */
    private function sanitazeData(array $data, ?Book $book = null): array
    {
        /* if ($book && isset($data['avatar'])) {
            $avatar = $this->sanitazeAvatar($data['avatar'], $book);
        }
        */
        return[
            ...$data,
           'place' => json_encode($data['place']),

        ];
    }

    private function sanitazeAvatar(UploadedFile $file): string
    {
        $image = Image::make($file)->resize(300, 300)->encode('png');
        $name = $file->hashName();
        dd($name, $image);

        return '$';
    }

    private function deleteOldAvatar(string $avatar): bool
    {
        return Storage::delete('/public/images/books/' . $avatar);
    }
}
