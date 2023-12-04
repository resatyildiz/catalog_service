<?php

namespace App\Http\Resources;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\OrderItemResource;

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
                "code" => $this->code,
                "description" => $this->description,
                "order_status_slug" => $this->order_status_slug,
                "customer_id" => $this->customer_id,
                "sale_channel_item_id" => $this->sale_channel_item_id,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ],
            'relationships' => [
                'item_count' => OrderItem::where('order_id', $this->id)->count(),
                'items' => OrderItemResource::collection(OrderItem::where('order_id', $this->id)->get())
            ]
        ];
    }
}
