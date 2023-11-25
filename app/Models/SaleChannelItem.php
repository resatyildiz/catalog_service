<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleChannelItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_channel_id',
        'sale_channel_item_group_id',
        'name',
        'description',
    ];
}
