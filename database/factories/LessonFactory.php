<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Discipline;
use App\Models\Faculty;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Journal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $user_ids = User::whereNotNull('department_id')->get(['id', 'department_id']);

        $user = $user_ids->random();

        $department_id = $user->department_id;

        $discipline_ids = Discipline::where('department_id', $department_id)->get('id');

        return [
            'user_id' => $user->id,
            'department_id' => $department_id,
            'day_type_id' => 3,
            'discipline_id' => $discipline_ids->random()->id,
            'time_start' => $this->faker->time('H:i:s'),
            'time_end' => $this->faker->time('H:i:s'),
            'year' => $this->faker->numberBetween(2018, 2020),
            'semester' => $this->faker->numberBetween(1, 12),
            'faculty_id' => Faculty::inRandomOrder()->value('id'),
            'course_number' => $this->faker->numberBetween(1, 6),
            'group_number' => $this->faker->numberBetween(1, 20),
        ];
    }
}
