<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\CourseContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countires = [
            ['title'=>'Казахстан',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        Country::insert($countires);
    }
}
