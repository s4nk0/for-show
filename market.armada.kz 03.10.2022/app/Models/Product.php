<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\IsBoolean;
use App\Traits\ElasticSearchable;
use App\Traits\IsJson;
use App\Traits\Scopes;
use App\Traits\UploadImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

//use Laravel\Scout\Searchable;                     15/10/20
//use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
//    use SoftDeletes;
//    use Translatable;

    // Мягкое удаление

    use AddEdit;
    use UploadImage;
    use IsBoolean;
    use IsJson;
    use Scopes;
    use Sluggable;
    use ElasticSearchable;

    public function sluggable(): array
    {
        $slug = $this->is_slug == true ? $this->slug : 'title';
        return ['slug' => ['source' => $slug]];
    }
//    use Searchable;           15/10/20
//    use SearchableTrait;

    protected $table = 'products_new';
    protected $with = array('store');
    const XLSX_IMPORT = 'xlsx';
    const CSV_IMPORT = 'csv';
    const XML_IMPORT = 'xml';

    protected $dates = ['deleted_at'];

    public $translatedAttributes = ['title', 'description','manufacture','seo_title','meta_description','meta_tags'];

    protected $fillable = [
        'isActive', 'status',
        'store_id', 'catalog_id', 'subcatalog_id', 'country_id', 'item_id',
        'is_delivery',
        'presence_id',
        'is_discount', 'discount',
        'title', 'price',
        'is_delivery',
        'description', 'articul', 'images', 'colors',
        'material',
        'manufacture',
        'width', 'height', 'depth', 'origin', 'status',
        'hits',
        'is_hot', 'fiver', 'used', 'is_slug', 'slug',
        'detail',
        'seo_title', 'meta_description', 'meta_tags','is_price_none','is_price_from','pay_ids','delivery_ids'
    ];

    protected $casts = [
        'colors' => 'array',
        'images' => 'array',
        'delivery_ids' => 'array',
        'pay_ids' => 'array'
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id', 'id')->withDefault(['title' => '<span class="text-danger font-weight-bold">нет данных !!!</span>']);
    }

    public function subcatalog()
    {
        return $this->belongsTo(Subcatalog::class, 'subcatalog_id', 'id')->withDefault(['title' => '<span class="text-danger font-weight-bold">нет данных !!!</span>']);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id')->withDefault(['title' => '<span class="text-danger font-weight-bold">нет данных !!!</span>']);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault([
            'title' => '<span class="text-danger font-weight-bold">нет данных !!!</span>',
            'address' => '<span class="text-danger font-weight-bold">нет данных !!!</span>',
        ]);
    }

    public function store_info(){
        return $this->belongsTo(Store::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function additional()
    {
        return $this->hasMany(ProductAdditional::class);//,'id','product_id'
    }

    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }

//    public function searchableAs()
//    {
//        return 'products';
//    }
//    public function order()
//    {
//        return $this->hasMany(Sellers\Order::class);
//    }
//    protected $searchable = [
//        'columns' => [
//            'products.title' => 5,
//        ]
//    ];

    // Scopes
    public function scopeActive($query)
    {
        $query = $query->where('isActive', true)
            ->whereHas('store', function ($q) {
                $q->where('status', true);
                $q->where('tarif_end_date', '>', now()->format('Y-m-d'));
            })
            ->whereHas('catalog', function ($q) {
                $q->where('isActive', true);
            })
            ->whereHas('subcatalog', function ($q) {
                $q->where('isActive', true);
            })
            ->whereHas('item', function ($q) {
                $q->where('isActive', true);
            })
            ->where('slug', '!=', null)
            ->where('images', '!=', null);
        return $query;
    }

//    public function getPriceAttribute()
//    {
//        return number_format($this->attributes['price'], 0, ',', ' ');
//    }

//    public function getPrice2Attribute()
//    {
//        return number_format($this->attributes['price_2'], 0, ',', ' ');
//    }

    public function setItem($ids)
    {
        if ($ids == null) {
            return;
        }

        $this->items()->sync($ids);
    }


//    public function priceProduct()
//    {
//        if ($this->price == 0) {
//            return 'Уточняйте у продавца';
//        }
//        return number_format($this->price, 0, ',', ' ');
//    }

    public function designerProjects(){
        return $this->belongsToMany(DesignerProject::class,'designer_project_product','product_id','designer_projects_id');
    }

}


