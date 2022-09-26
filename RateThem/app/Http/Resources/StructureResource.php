<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StructureResource extends JsonResource
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
            'nom' => $this->nom,
            'slug' => $this->slug,
            'description' => $this->description,
            'address' => $this->address,
            'tel1' => $this->tel1,
            'tel2' => $this->tel2,
            'horaires' => $this->horaires,
            'user' => $this->whenLoaded("user"),
        ];
    }
}
