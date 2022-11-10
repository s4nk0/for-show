<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\IsBoolean;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Page extends Model implements TranslatableContract
{
    use HasFactory;

    use AddEdit;
    use IsBoolean;

    use Translatable;

    public $translatedAttributes = ['body'];

    protected $fillable = [
        'isActive',
        'title',
        'body',
        'slug',
        'is_banner',
        'meta_description',
        'meta_keywords'
    ];
}
