<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            ['name' => 'Лечебный','speciality' => 'Лечебое дело', 'tag' => 'Леч', 'color' => 'green'],
            ['name' => 'Педиатрический', 'speciality' => 'Педиатрия', 'tag' => 'Пед', 'color' => 'purple'],
            ['name' => 'Медико-биологический',' speciality' => 'Медицинская биохимия', 'tag' => 'МБФ', 'color' => 'blue'],
            ['name' => 'Стоматологический', 'speciality' => 'Стоматология', 'tag' => 'Стом', 'color' => 'red'],
            ['name' => 'Медико-профилактический', 'speciality' => 'Медико-профилактическое дело', 'tag' => 'МПД', 'color' => 'gray'],
            ]);
    }
}
