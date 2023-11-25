<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'value',
        'status',
        'setting_id',
        'is_required',
        'media_id',
    ];
}
