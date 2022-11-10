<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_number',
        'car_categories_id',
        'transport_type_id',
        'is_active',
        'photo_face',
        'photo_left_side',
        'photo_right_side',
        'photo_back',
    ];
}
