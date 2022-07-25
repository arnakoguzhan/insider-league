<?php

namespace Database\Factories;

use App\Models\Simulation;
use App\Models\Standing;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class StandingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Standing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'team_id' => Team::factory(),
            'simulation_id' => Simulation::factory(),
            'points' => $this->faker->numberBetween(0, 100),
            'played' => $this->faker->numberBetween(0, 100),
            'won' => $this->faker->numberBetween(0, 100),
            'lost' => $this->faker->numberBetween(0, 100),
            'draw' => $this->faker->numberBetween(0, 100),
            'goal_difference' => $this->faker->numberBetween(0, 100),
        ];
    }
}
