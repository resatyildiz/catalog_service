<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->id,
            "attributes" => [
                "name" => $this->name,
                "slug" => $this->slug,
                "description" => $this->description,
                "order" => $this->order,
                "media_id" => $this->media_id,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            'relationships' => [
                'products' => Product::where('category_id', $this->id)->leftJoin('media', 'products.media_id', '=', 'media.id')->select('products.*', 'media.url as media_url')->get(),
                "media" => $this->media,
            ]
        ];
    }
}
