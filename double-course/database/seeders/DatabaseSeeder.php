<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AffirmationText;
use App\Models\AudioContent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            AudioContentSeeder::class,
            AffirmationTextSeeder::class,
            CourseSeeder::class,
            CourseContentSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            UserSeeder::class,
            UserNoteSeeder::class,
        ]);
    }
}
