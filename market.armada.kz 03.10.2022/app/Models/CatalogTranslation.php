<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogTranslation extends Model
{
    /*  'index','isActive',
        'title','menu_title','meta_title',
        'meta_desc','meta_tag','h1',
        'svg','images',*/
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['locale','title','h1','menu_title','catalog_id'];
}
