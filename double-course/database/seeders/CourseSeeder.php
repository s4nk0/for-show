<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ['title'=>'Обучение и практика',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['title'=>'Мини-курсы',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['title'=>'Вебинары',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        Course::insert($courses);
    }
}
