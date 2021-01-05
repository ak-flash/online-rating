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
            'user_id' => $this->faker->numberBetween(1, 30),
            'department_id' => $this->faker->numberBetween(10, 20),
            'day_type_id' => 3,
            'discipline_id' => $this->faker->numberBetween(1, 10),
            'time_start' => $this->faker->time('H:i:s'),
            'time_end' => $this->faker->time('H:i:s'),
            'year' => $this->faker->numberBetween(2018, 2020),
            'semester' => $this->faker->numberBetween(1, 12),
            'faculty_id' => $this->faker->numberBetween(1, 5),
            'course_number' => $this->faker->numberBetween(1, 6),
            'group_number' => $this->faker->numberBetween(1, 20),
        ];
    }
}
