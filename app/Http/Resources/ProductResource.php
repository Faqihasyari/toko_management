<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'thumbnail' => $this->thumbnail,
            'about'    => $this->about,
            'price'    => $this->price,
            'is_popular' => $this->is_popular,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
