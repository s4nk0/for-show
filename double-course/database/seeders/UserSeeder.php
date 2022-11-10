<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'phone' => '+77072196303',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user->roles()->attach(1);

        $user = User::create([
            'name' => 'Test Main',
            'phone' => '+77072196302',
        ]);

        $user->roles()->attach(2);

        $user = User::create([
            'name' => 'Test',
            'phone' => '+77777777778',
        ]);

        $user->roles()->attach(2);

        $user = User::create([
            'name' => 'Test',
            'phone' => '+77777777779',
        ]);

        $user->roles()->attach(2);

        $user = User::create([
            'name' => 'Test',
            'phone' => '+77777777710',
        ]);

        $user->roles()->attach(2);

        DB::table('user_invite')->insert(['user_id'=>'2','invited_user_id'=>'1']);
        DB::table('user_invite')->insert(['user_id'=>'2','invited_user_id'=>'3']);
        DB::table('user_invite')->insert(['user_id'=>'2','invited_user_id'=>'4']);

        DB::table('user_course_contents')->insert(['user_id'=>2,'course_content_id'=>1]);
        DB::table('user_course_contents')->insert(['user_id'=>2,'course_content_id'=>2]);
        DB::table('user_course_contents')->insert(['user_id'=>2,'course_content_id'=>3]);

        DB::table('user_audio_content')->insert(['user_id'=>2,'content_id'=>3]);
        DB::table('user_audio_content')->insert(['user_id'=>2,'content_id'=>2]);
        DB::table('user_audio_content')->insert(['user_id'=>2,'content_id'=>1]);

        DB::table('like_audio_content')->insert(['user_id'=>2,'content_id'=>1]);
        DB::table('like_audio_content')->insert(['user_id'=>2,'content_id'=>2]);
        DB::table('like_audio_content')->insert(['user_id'=>2,'content_id'=>3]);
    }
}
