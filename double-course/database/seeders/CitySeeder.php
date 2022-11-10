<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['country_id'=>'1','title'=>'Алматы',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['country_id'=>'1','title'=>'Нур-Султан',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['country_id'=>'1','title'=>'Актау',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['country_id'=>'1','title'=>'Тараз',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        City::insert($cities);
    }
}
