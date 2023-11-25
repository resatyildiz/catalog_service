<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sale_channel_type_id',
        'status',
        'slug'
    ];
}
