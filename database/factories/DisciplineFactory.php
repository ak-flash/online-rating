<?php

namespace Database\Factories;

use App\Models\Discipline;
use Illuminate\Database\Eloquent\Factories\Factory;

class DisciplineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Discipline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'department_id' => $this->faker->numberBetween(10, 20),
            'semester' => $this->faker->numberBetween(1, 12),
            'faculty_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
