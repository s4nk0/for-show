<?php

namespace Database\Seeders;

use App\Models\AudioContent;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AudioContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $audio = [

            ['subcategory_id'=>'1',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => "Медитация для тех, кто хочет: <br>
            • Вернуть ресурсное состояние <br>
            • Понять, что жизнь прекрасна <br>
            • Отпустить всю грусть и печаль <br> <br>
            Благодаря этой волшебной практике вы почувствуете внутреннее спокойствие, любовь и большую заботу
            ",
                "path"=>"storage/audio/meditation/meditation.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'1',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => "Медитация для тех, кто хочет: <br>
            • Вернуть ресурсное состояние <br>
            • Понять, что жизнь прекрасна <br>
            • Отпустить всю грусть и печаль <br> <br>
            Благодаря этой волшебной практике вы почувствуете внутреннее спокойствие, любовь и большую заботу
            ",
                "path"=>"storage/audio/meditation/meditation.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'1',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => "Медитация для тех, кто хочет: <br>
            • Вернуть ресурсное состояние <br>
            • Понять, что жизнь прекрасна <br>
            • Отпустить всю грусть и печаль <br> <br>
            Благодаря этой волшебной практике вы почувствуете внутреннее спокойствие, любовь и большую заботу
            ",
                "path"=>"storage/audio/meditation/meditation.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'1',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => "Медитация для тех, кто хочет: <br>
            • Вернуть ресурсное состояние <br>
            • Понять, что жизнь прекрасна <br>
            • Отпустить всю грусть и печаль <br> <br>
            Благодаря этой волшебной практике вы почувствуете внутреннее спокойствие, любовь и большую заботу
            ",
                "path"=>"storage/audio/meditation/meditation.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'6',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => null,
                "path"=>"storage/audio/meditation/meditation.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'6',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => null,
                "path"=>"storage/audio/meditation/meditation.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['subcategory_id'=>'6',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => null,
                "path"=>"storage/audio/affirmations/affirmations.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'6',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => null,
                "path"=>"storage/audio/affirmations/affirmations.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'6',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" =>null,
                "path"=>"storage/audio/affirmations/affirmations.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['subcategory_id'=>'6',"title"=>"Медитация избавления от депрессии, тревоги и стресса",
                "description" => null,
                "path"=>"storage/audio/affirmations/affirmations.mp3",
                "created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        AudioContent::insert($audio);
    }
}
