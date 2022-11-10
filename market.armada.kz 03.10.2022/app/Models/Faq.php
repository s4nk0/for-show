<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\IsBoolean;
use App\Traits\Scopes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model implements TranslatableContract
{
    use HasFactory;
    use AddEdit;
    use Scopes;
    use IsBoolean;
    use Translatable;

    public $translatedAttributes = ['title','description'];

    protected $fillable = [
        'isActive','type','index',
        'title','description'
    ];

}
