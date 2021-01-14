<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Discipline;
use App\Models\Faculty;
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
        static $department_id = 1;
        $departments = Department::all('id');

        if($department_id > $departments->count()) {
            $department_id = 1;
        }

        return [
            'name' => $this->faker->sentence(),
            'department_id' => $department_id++,
            'semester' => $this->faker->numberBetween(1, 12),
            'faculty_id' => Faculty::inRandomOrder()->value('id'),
        ];
    }
}
