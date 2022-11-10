<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\Scopes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDelivery extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    use AddEdit, Scopes;
    protected $fillable = ['isActive','title'];
    public $translatedAttributes = ['title'];
}
