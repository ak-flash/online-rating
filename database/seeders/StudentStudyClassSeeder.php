<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Lesson;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StudentStudyClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5500; $i++) {
            DB::table('student_study_class')->insert(
                [
                    'student_id' => Student::inRandomOrder()->value('id'),
                    'study_class_id' => Lesson::inRandomOrder()->value('id'),
                    'mark1' => rand(2, 5),
                    'mark2' => rand(2, 5),
                    'user_id' => User::inRandomOrder()->value('id'),
                    'attendance' => rand(0, 1),
                ]
            );
        }
    }
}
