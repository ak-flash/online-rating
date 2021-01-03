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
            'title' => $this->faker->text(30),
            'type' => $this->faker->numberBetween(1, 4),
        ];
    }
}
