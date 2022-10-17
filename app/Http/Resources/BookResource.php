<?php

namespace App\Http\Resources;

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
            'institution_id' => $this->institution_id,
            'name' => $this->name,
            'description' => $this->description,
            'classification' => $this->classification,
            'author' => $this->author,
            'publisher' => $this->publisher,
            'amount' => $this->amount,
            'avatar' => $this->avatar,
            'status' => $this->status,
        ];
    }
}
