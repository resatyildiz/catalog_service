<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

class OrderItemResource extends JsonResource
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
            'attributes' =>  [
                'id' => (string)$this->id,
                'product_id' => $this->product_id,
                'order_id' => $this->order_id,
                'status_id' => $this->status_id,
                'quantity' => $this->quantity,
                'price' => $this->price,
                'note' => $this->note,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'product' => Product::findOrFail($this->product_id)
            ]
        ];
    }
}
