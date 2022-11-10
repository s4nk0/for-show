<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\IsBoolean;
use App\Traits\Scopes;
use App\Traits\UploadImage;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model implements TranslatableContract
{
    use HasFactory;

    use AddEdit;
    use UploadImage;
    use IsBoolean;
    use Scopes;
    use Sluggable;
    use Translatable;

    public $translatedAttributes = ['title','description'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $fillable = [
        'isActive','index','slug',
        'title','description','image','phone','email','url'
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
