<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CourseContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courseContents = [
            ['title'=>'title','course_id'=>'1',"path" => '70591644','material_path'=>'storage/course/materials/material.docx','length'=>'5','description'=>"Quis egestas amet nisi, nulla elementum in et nulla. Faucibus venenatis, in euismod ipsum non. Praesent facilisis morbi dolor arcu nunc, quam sodales mollis. Sed curabitur id platea eu, odio in netus placerat. Risus vel cras et nibh faucibus. In mauris nulla molestie nunc luctus lectus. Elit.","created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now(),'picture'=>'https://i.vimeocdn.com/video/1536932495-0165f26183927c1209e4234fd8812cf1361866ddd79145e3c33a413e09a3963d-d_960x540?r=pad'],
            ['title'=>'title','course_id'=>'2',"path" => '70591644','material_path'=>'storage/course/materials/material.docx','length'=>'5','description'=>"Quis egestas amet nisi, nulla elementum in et nulla. Faucibus venenatis, in euismod ipsum non. Praesent facilisis morbi dolor arcu nunc, quam sodales mollis. Sed curabitur id platea eu, odio in netus placerat. Risus vel cras et nibh faucibus. In mauris nulla molestie nunc luctus lectus. Elit.","created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now(),'picture'=>'https://i.vimeocdn.com/video/1536932495-0165f26183927c1209e4234fd8812cf1361866ddd79145e3c33a413e09a3963d-d_960x540?r=pad'],
            ['title'=>'title','course_id'=>'3',"path" => '70591644','material_path'=>'storage/course/materials/material.docx','length'=>'5','description'=>"Quis egestas amet nisi, nulla elementum in et nulla. Faucibus venenatis, in euismod ipsum non. Praesent facilisis morbi dolor arcu nunc, quam sodales mollis. Sed curabitur id platea eu, odio in netus placerat. Risus vel cras et nibh faucibus. In mauris nulla molestie nunc luctus lectus. Elit.","created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now(),'picture'=>'https://i.vimeocdn.com/video/1536932495-0165f26183927c1209e4234fd8812cf1361866ddd79145e3c33a413e09a3963d-d_960x540?r=pad'],
        ];

        CourseContent::insert($courseContents);
    }
}
