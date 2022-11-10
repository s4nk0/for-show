<?php

namespace Database\Seeders;

use App\Models\AffirmationCategory;
use App\Models\AffirmationText;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AffirmationTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $affirmationText = [
            ['content_id'=>'5',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['content_id'=>'5',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['content_id'=>'6',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['content_id'=>'6',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['content_id'=>'7',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['content_id'=>'7',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['content_id'=>'8',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['content_id'=>'8',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['content_id'=>'9',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['content_id'=>'9',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],

            ['content_id'=>'10',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['content_id'=>'10',"text" => 'В моей жизни длительные и счастливые отношения','delay'=>'5',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],


        ];

        AffirmationText::insert($affirmationText);
    }
}
