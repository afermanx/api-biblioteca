<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Rent;
use App\Traits\ApiException;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class RentService
{
    use ApiException;


    /**
     * list all rents with oarams to paginate in the request
     *
     * @param array $data
     * @return Rent
     */
    public function listAll(array $data): LengthAwarePaginator
    {
        $perPage = $data['perPage'] ?? 10;

        $rents = Rent::with('book', 'user');
        if (isset($data['user_id'])) {
            $rents->where('user_id', $data['user_id']);
        }
        if (isset($data['user_name'])) {
            $rents->whereHas('user', function ($query) use ($data) {
                $query->where('name', 'ilike', '%'.$data['user_name'].'%');
            });
        }
        if (isset($data['book_id'])) {
            $rents->where('book_id', $data['book_id']);
        }
        if (isset($data['rented_by'])) {
            $rents->where('rented_by', 'ilike', '%'.$data['rented_by'].'%');
        }
        if (isset($data['due_date'])) {
            $rents->where('due_date', 'like', '%'.$data['due_date'].'%');
        }
        if (isset($data['book_name'])) {
            $rents->whereHas('book', function ($query) use ($data) {
                $query->where('name', 'ilike', '%'.$data['book_name'].'%');
            });
        }

        return $rents->paginate($perPage);
    }
    /**
     * rent a book
     *
     * @param array $data
     * @return Rent
     */
    public function rent(array $data): Rent
    {
        $book = Book::find($data['book_id']);

        if ($book->amount <= 0) {
            $this->badRequestException(['message' => 'Livro indisponível para empréstimo']);
        }
        $book->amount -= 1;
        $book->save();
        if ($this->rentExist($data['book_id'], $data['user_id'])) {
            $this->badRequestException(['message' => 'Você já possui um empréstimo deste livro']);
        }
        $rent = Rent::create($this->sanitazeData($data, $book));

        return $rent;
    }

    /**
     * sanitaza data
     *
     * @param array $data
     * @param Book $book
     * @return array
     */
    private function sanitazeData(array $data, Book $book): array
    {
        $isDidactic = $book->categories()->whereName('didatico')->exists();

        return [
            'book_id' => $data['book_id'],
            'user_id' => $data['user_id'],
            'rented_by' => Auth::user()->name,
            'due_date' =>  $isDidactic ? now()->addYears(1) : now()->addDays($data['days']),
        ];
    }

    /**
     * check if rent exist
     *
     * @param integer $bookId
     * @param integer $userId
     * @return boolean
     */
    private function rentExist(int $bookId, int $userId): bool
    {
        return Rent::whereBookId($bookId)->whereUserId($userId)->exists();
    }
}
