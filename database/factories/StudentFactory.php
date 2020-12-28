<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_id' => $this->faker->randomNumber(9, true),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'faculty_id' => $this->faker->numberBetween(1, 5),
            'course_number' => $this->faker->numberBetween(1, 6),
            'group_number' => $this->faker->numberBetween(1, 10),
        ];
    }
}
