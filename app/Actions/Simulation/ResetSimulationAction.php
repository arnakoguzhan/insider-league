<?php

namespace App\Actions\Simulation;

use App\Actions\Fixture\GenerateNewFixtureAction;
use App\Actions\Standing\CreateStandingsAction;
use App\Models\Simulation;
use App\Traits\AsAction;

class ResetSimulationAction
{
    use AsAction;

    public function handle(Simulation $simulation)
    {
        // Remove old standings then create new
        $this->refreshStandings($simulation);

        // Remove old fixtures then create new
        $this->refreshFixtures($simulation);
    }

    public function refreshStandings(Simulation $simulation)
    {
        // Remove standings
        $simulation->standings()->delete();

        // Create standings for the simulation
        CreateStandingsAction::run($simulation);
    }

    public function refreshFixtures(Simulation $simulation)
    {
        // Remove fixtures
        $simulation->fixtures()->delete();

        // Create fixtures for the simulation
        GenerateNewFixtureAction::run($simulation);
    }
}
