<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use App\Models\User;
use App\Models\UserNote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notes = [
            ['user_id'=>'2',"title" => 'Заметка этого дня',"description" => 'Congue lobortis mauris aliquet mi, nulla sed. Risus odio commodo metus vestibulum. Mi volutpat vestibulum pharetra fringilla consectetur dignissim sociis. Consequat at amet aliquam sodales sit vitae ultrices quam non. Sed morbi quis fringilla urna, ut senectus mattis. Morbi sit blandit.','profile_photo_path'=>User::find(2)->profile_photo_url,'emoji'=>'😀',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['user_id'=>'2',"title" => 'Заметка этого дня',"description" => 'Congue lobortis mauris aliquet mi, nulla sed. Risus odio commodo metus vestibulum. Mi volutpat vestibulum pharetra fringilla consectetur dignissim sociis. Consequat at amet aliquam sodales sit vitae ultrices quam non. Sed morbi quis fringilla urna, ut senectus mattis. Morbi sit blandit.','profile_photo_path'=>User::find(2)->profile_photo_url,'emoji'=>'😀',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['user_id'=>'2',"title" => 'Заметка этого дня',"description" => 'Congue lobortis mauris aliquet mi, nulla sed. Risus odio commodo metus vestibulum. Mi volutpat vestibulum pharetra fringilla consectetur dignissim sociis. Consequat at amet aliquam sodales sit vitae ultrices quam non. Sed morbi quis fringilla urna, ut senectus mattis. Morbi sit blandit.','profile_photo_path'=>User::find(2)->profile_photo_url,'emoji'=>'😀',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['user_id'=>'2',"title" => 'Заметка этого дня',"description" => 'Congue lobortis mauris aliquet mi, nulla sed. Risus odio commodo metus vestibulum. Mi volutpat vestibulum pharetra fringilla consectetur dignissim sociis. Consequat at amet aliquam sodales sit vitae ultrices quam non. Sed morbi quis fringilla urna, ut senectus mattis. Morbi sit blandit.','profile_photo_path'=>User::find(2)->profile_photo_url,'emoji'=>'😀',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
            ['user_id'=>'2',"title" => 'Заметка этого дня',"description" => 'Congue lobortis mauris aliquet mi, nulla sed. Risus odio commodo metus vestibulum. Mi volutpat vestibulum pharetra fringilla consectetur dignissim sociis. Consequat at amet aliquam sodales sit vitae ultrices quam non. Sed morbi quis fringilla urna, ut senectus mattis. Morbi sit blandit.','profile_photo_path'=>User::find(2)->profile_photo_url,'emoji'=>'😀',"created_at" => \Carbon\Carbon::now(), "updated_at" => \Carbon\Carbon::now()],
        ];

        UserNote::insert($notes);
    }
}
