<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        "orders_id",
        "sale_channel_items_id",
        "payment_method_type",
        "price",
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, "orders_id", "id");
    }
}
