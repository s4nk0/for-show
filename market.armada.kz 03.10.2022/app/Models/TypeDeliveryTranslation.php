<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDeliveryTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['locale','title','type_delivery_id'];
}
