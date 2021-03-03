<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Кляусов Андрей Сергеевич',
            'email' => 'ak-flash@mail.ru',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role_id' => 1,
            'department_id' => 18,
        ]);
    }
}
