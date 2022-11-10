<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePayTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['locale','title','type_pay_id'];
}
