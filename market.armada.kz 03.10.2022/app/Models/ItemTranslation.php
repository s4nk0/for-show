<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
    use HasFactory;
    /*'index','isActive','is_popular',
        'subcatalog_id',
        'slug','h1','title','menu_title',
        'images',
        'meta_title','meta_desc','meta_tag','seo_text'*/
    public $timestamps = false;
    protected $fillable = ['locale','title','h1','menu_title','item_id'];
}
