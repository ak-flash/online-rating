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
            ['name' => 'Лечебный', 'tag' => 'Леч', 'color' => 'green'],
            ['name' => 'Педиатрический', 'tag' => 'Пед', 'color' => 'purple'],
            ['name' => 'Медико-биологический', 'tag' => 'МБФ', 'color' => 'blue'],
            ['name' => 'Стоматологический', 'tag' => 'Стом', 'color' => 'red'],
            ['name' => 'Медико-профилактическое дело', 'tag' => 'МПД', 'color' => 'gray'],
            ]);
    }
}
