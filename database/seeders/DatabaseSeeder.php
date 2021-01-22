<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Faculty;
use App\Models\Journal;
use App\Models\Student;
use App\Models\Lesson;
use App\Models\User;
use Database\Factories\LessonsFactory;
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
            // TopicSeeder::Seeder::class,
            // StudentStudyClassSeeder::class,
        ]);

        // User::factory(10)->create();
         Student::factory(500)->create();
        // Discipline::factory(100)->create();

        // Journal::factory(100)->create();
        // Lesson::factory(100)->create();





    }
}
