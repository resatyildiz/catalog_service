<?php

namespace App\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
                'item_count' => OrderItem::where('order_id', $this->id)->count(),
            ]
        ];
    }
}
