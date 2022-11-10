<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
            ['category_id'=>'1',"icon" => 'img\affirmation\icons\love.svg',"title" => 'Богатство',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'1',"icon" => 'img\affirmation\icons\love.svg',"title"=>'Любовь',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'1',"icon" => 'img\affirmation\icons\love.svg',"title"=>'Здоровье',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'1',"icon" => 'img\affirmation\icons\love.svg',"title"=>'Успех',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'1',"icon" => 'img\affirmation\icons\love.svg',"title"=>'Карьера',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['category_id'=>'2',"icon" => 'img\affirmation\icons\love.svg',"title" => 'Здоровье',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'2',"icon"=>'img\affirmation\icons\rich.svg',"title"=>'Успех',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'2',"icon"=>'img\affirmation\icons\relation.svg',"title"=>'Любовь',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'2',"icon"=>'img\affirmation\icons\relation.svg',"title"=>'Богатство',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['category_id'=>'2',"icon"=>'img\affirmation\icons\relation.svg',"title"=>'Благодарность',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        Subcategory::insert($subcategories);
    }
}
