<?php

namespace Database\Seeders;

use App\Models\Faculty;
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
        $this->call([
            // FacultySeeder::class,
            // DepartmentSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Student::factory(500)->create();
        // \App\Models\Discipline::factory(10)->create();
        // \App\Models\Lesson::factory(100)->create();

    }
}
