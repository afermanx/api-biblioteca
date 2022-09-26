<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'institution_id' => $this->institution_id,
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'status' => $this->status,
            'is_admin'=>$this->is_admin
        ];
    }
}
