<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $table = 'course_content';

    protected $fillable = [
      'course_id',
        'material_path',
        'path',
        'length',
        'description',
        'title',
        'picture'
    ];

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
