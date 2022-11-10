<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable =[
        'category_id',
        'title'
    ];

    public function contents(){
        return $this->hasMany(AudioContent::class);
    }

    public function category(){
        return $this->hasOne(Category::class,'id');
    }
}
