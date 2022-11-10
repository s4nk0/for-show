<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubcatalogTranslation extends Model
{
    use HasFactory;
    /*'index','isActive','is_popular',
        'catalog_id',
        'is_slug',
        'slug','title',
        'meta_title','meta_desc','meta_tag','seo_text','h1',
        'hits',
        'images',
        'onpopular'*/
    public $timestamps = false;
    protected $fillable = ['locale','title','h1','subcatalog_id'];
}
