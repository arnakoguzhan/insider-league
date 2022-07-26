<?php

namespace App\Actions\Fixture;

use App\Models\Fixture;
use App\Models\Simulation;
use App\Models\Team;
use App\Services\FixtureService;
use App\Traits\AsAction;

class GenerateNewFixtureAction
{
    use AsAction;

    public function handle(Simulation $simulation)
    {
        // Fetch teams from database
        $teams = Team::pluck('id')->toArray();

        // Generate fixture
        $schedule = FixtureService::addTeams($teams)->schedule();

        // Save fixtures to database
        foreach ($schedule as $round => $fixtures) {
            foreach ($fixtures as $fixture) {
                Fixture::create([
                    'simulation_id' => $simulation->id,
                    'week' => $fixture['round'],
                    'host_fc_id' => $fixture['host'],
                    'guest_fc_id' => $fixture['guest'],
                    'played_at' => null,
                ]);
            }
        }
    }
}
