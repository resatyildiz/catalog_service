<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleChannelType extends Model
{
    use HasFactory;

    protected $table = "sale_channel_types";

    protected $fillable = [
        "name"
    ];
}
