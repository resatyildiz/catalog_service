<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleChannelItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_channel_slug',
        'sale_channel_item_group_id',
        'name',
        'description',
    ];


    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, "sale_channel_item_id", "id");
    }
}
