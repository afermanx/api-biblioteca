<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'book' => BookResource::make($this->book),
            'user' => UserResource::make($this->user),
            'rented_by' => $this->rented_by,
            'due_date' => Carbon::create($this->due_date)->format('Y-m-d H:i:s'),
        ];

    }
}
