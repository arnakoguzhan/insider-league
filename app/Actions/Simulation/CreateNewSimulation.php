<?php

namespace App\Actions\Simulation;

use App\Actions\Fixture\GenerateNewFixtureAction;
use App\Actions\Standing\CreateStandingsAction;
use App\Models\Simulation;
use App\Traits\AsAction;

class CreateNewSimulation
{
    use AsAction;

    public function handle()
    {
        // Create a new simulation
        $simulation = Simulation::create();

        // Create standings for the simulation
        CreateStandingsAction::run($simulation);

        // Generate the fixtures for the simulation
        GenerateNewFixtureAction::run($simulation);

        return $simulation;
    }
}
