<?php

namespace App\Actions\Simulation;

use App\Models\Simulation;
use App\Models\Team;
use App\Traits\AsAction;

class CreateNewSimulation
{
    use AsAction;

    public function handle()
    {
        $simulation = Simulation::create();

        // Create standings for the simulation
        $teams = Team::all();
        foreach ($teams as $team) {
            $simulation->standings()->create([
                'team_id' => $team->id,
                'points' => 0,
                'played' => 0,
                'won' => 0,
                'lost' => 0,
                'draw' => 0,
                'goal_difference' => 0,
            ]);
        }

        return $simulation;
    }
}
