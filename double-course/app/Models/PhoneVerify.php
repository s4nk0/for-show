<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PhoneVerify extends Model
{
    use Notifiable;

    protected $table = 'phone_verified';

    protected $fillable = [
        'phone',
        'code'
    ];

    public function routeNotificationForSmscru()
    {
        return $this->phone;
    }
}
