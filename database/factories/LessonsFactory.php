<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\Journal;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lesson_id = Journal::inRandomOrder()->value('id');
        $topic_id = Topic::inRandomOrder()->value('id');

        return [
            'lesson_id' => $lesson_id,
            'topic_id' => $topic_id,
            'date' => $this->faker->date(),
            'type_id' => $this->faker->numberBetween(1, 4),
            'time_start' => $this->faker->time('H:i:s'),
            'time_end' => $this->faker->time('H:i:s'),
        ];
    }
}
