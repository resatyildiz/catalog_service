<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // protected $table = 'orders';

    protected $fillable = [
        'code',
        'description',
        /**
         * Foreign Keys
         */
        'customer_id',
        'sale_channel_item_id',
        'order_status_slug'
    ];
}
