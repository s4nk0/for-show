<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\IsBoolean;
use App\Traits\IsJson;
use App\Traits\Scopes;
use App\Traits\UploadImage;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
//use App\Models\{Catalog, Item, Product};

class Subcatalog extends Model implements TranslatableContract
{
    use AddEdit;
    use UploadImage;
    use IsBoolean;
    use IsJson;
    use Scopes;
    use Sluggable;
    use Translatable;

    public $translatedAttributes = ['title','h1'];

    public function sluggable(): array
    {
        $slug = $this->is_slug == true ? $this->slug : 'title' ;
        return [ 'slug' => ['source' => $slug] ];
    }

    protected $table = 'subcatalogs';

    protected $fillable = [
        'index','isActive','is_popular',
        'catalog_id',
        'is_slug',
        'slug','title',
        'meta_title','meta_desc','meta_tag','seo_text','h1',
        'hits',
        'images',
        'onpopular'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class)->withDefault(['title'=>'нет данных']);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    const DISCOUNT_ZONE_ID = 49;
}
