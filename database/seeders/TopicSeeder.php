<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = \App\Models\Topic::factory(500)->make();

        foreach ($topics as $topic) {
            repeat:
            try {
                $topic->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $topic = \App\Models\Topic::factory()->make();
                goto repeat;
            }
        }
    }
}
