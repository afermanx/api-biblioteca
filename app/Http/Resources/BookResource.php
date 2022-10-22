<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'categories' => $this->categories->map(function ($category) {
                return new CategoryResource($category);
            }),
            'library_id' => $this->library_id,
            'name' => $this->name,
            'description' => $this->description,
            'classification' => $this->classification,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'amount' => $this->amount,
            'shelf' => json_decode($this->shelf),
            'avatar' => $this->avatar,
            'status' => $this->status,
        ];
    }
}
