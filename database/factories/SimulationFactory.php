<?php

namespace Database\Factories;

use App\Actions\Fixture\GenerateNewFixtureAction;
use App\Actions\Standing\CreateStandingsAction;
use App\Models\Simulation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimulationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Simulation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uid' => $this->faker->unique()->uuid,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Simulation $simulation) {
            // Generate the fixtures.
            GenerateNewFixtureAction::run($simulation);

            // Create standings for the simulation
            CreateStandingsAction::run($simulation);
        });
    }
}
