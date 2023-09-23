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
            "id" => (string)$this->id,
            "attributes" => [
                "name" => $this->name,
                "slug" => $this->slug,
                "price" => $this->price,
                "description" => $this->description,
                "media_id" => $this->media_id,
                "order" => $this->order,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            "relationships" => [
                "category_id" => (string)$this->category->id,
                "category" => $this->category,
                "media" => $this->media,
            ],
        ];
    }
}
