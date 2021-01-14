<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\Faculty;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $discipline_id = Discipline::inRandomOrder()->value('id');

        return [
            'title' => $this->faker->sentence(),
            'discipline_id' => $discipline_id,
            't_number' => $this->faker->numberBetween(1, 50),
        ];
    }
}
