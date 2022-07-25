<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'handle' => $this->faker->unique()->userName(),
            'imageUrl' => $this->faker->imageUrl(),
            'attackRating' => $this->faker->numberBetween(70, 100),
            'midfieldRating' => $this->faker->numberBetween(70, 100),
            'defenceRating' => $this->faker->numberBetween(70, 100),
        ];
    }
}
