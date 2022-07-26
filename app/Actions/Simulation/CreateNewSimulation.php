<?php

namespace App\Actions\Simulation;

use App\Actions\Standing\CreateStandingsAction;
use App\Models\Simulation;
use App\Traits\AsAction;

class CreateNewSimulation
{
    use AsAction;

    public function handle()
    {
        $simulation = Simulation::create();

        // Create standings for the simulation
        CreateStandingsAction::run($simulation);

        return $simulation;
    }
}
