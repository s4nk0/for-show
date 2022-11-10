<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title'=>'🧘 Медитация','audio_path'=>'meditation',"description" => 'Ежедневные медитации созданы для трансформации человека день за днем',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['title'=>' 💆🏻‍♀️ Аффирмация','audio_path'=>'affirmation',"description"=>'Ежедневные аффирмации созданы для трансформации человека день за днем',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        Category::insert($categories);
    }
}
