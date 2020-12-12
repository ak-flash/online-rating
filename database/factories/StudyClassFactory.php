<?php

namespace Database\Factories;

use App\Models\StudyClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyClassFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudyClass::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'team_id' => $this->faker->numberBetween(1, 7),
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'faculty_id' => $this->faker->numberBetween(1, 5),
            'course_id' => $this->faker->numberBetween(1, 6),
            'group_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
