<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['locale','page_id','body'];
   /* protected $translationForeignKey = 'page_slug';*/
}
