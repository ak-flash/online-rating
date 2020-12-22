<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
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
        return [
            'user_id' => $this->faker->numberBetween(1, 40),
            'team_id' => $this->faker->numberBetween(1, 7),
            'title' => $this->faker->text(30),
            'type' => $this->faker->numberBetween(1, 4),
            'date' => $this->faker->date(),
            'faculty_id' => $this->faker->numberBetween(1, 5),
            'course_number' => $this->faker->numberBetween(1, 6),
            'group_number' => $this->faker->numberBetween(1, 20),
        ];
    }
}
