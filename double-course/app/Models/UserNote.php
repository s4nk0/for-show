<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class UserNote extends Model
{
    use HasFactory;
    use HasProfilePhoto;

    protected $appends = [
        'profile_photo_url',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'emoji',
    ];
}
