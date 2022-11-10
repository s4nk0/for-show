<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\IsBoolean;
use App\Traits\UploadImage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignerProject extends Model
{
    use HasFactory;
    use AddEdit;        // Добавление/редактирование
    use UploadImage;    // Работа с изображениями
    use IsBoolean;         // набор запросов
    use Sluggable;
    public function sluggable():array
    {
        $slug = $this->is_slug == true ? $this->slug : 'title' ;
        return [ 'slug' => ['source' => $slug] ];
    }

    protected $fillable = [
        'title','type_object','size','price','visual','description','user_id','designer_category_id','slug','address','designer_style_id'
    ];

    public function designerStyles()
    {
        return $this->belongsTo(DesignerStyle::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class,'designer_project_product','designer_projects_id','product_id');
    }


}
