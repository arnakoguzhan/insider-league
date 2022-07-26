<?php

namespace App\Actions\Simulation;

use App\Actions\Fixture\UpdateFixtureAction;
use App\Models\Fixture;
use App\Services\PredictionService;
use App\Traits\AsAction;
use Illuminate\Support\Collection;

class PlayWeekAction
{
    use AsAction;

    public function handle($fixtures)
    {
        // Check if the fixture is a collection, then iterate over it
        if ($fixtures instanceof Collection) {
            // Play the next week
            $fixtures->each(function (Fixture $fixture) {
                $this->playWeek($fixture);
            });
        } else {
            // Play the next week
            $this->playWeek($fixtures);
        }
    }

    /**
     * Play the week of the fixture.
     *
     * @param \App\Models\Fixture $fixture
     *
     * @return void
     */
    protected function playWeek(Fixture $fixture)
    {
        // Make sure the fixture is not played already
        if (!$fixture->isPlayed()) {
            // New Prediction Service
            $predictionService = new PredictionService();
            $scores = $predictionService->predictScores($fixture->host, $fixture->guest);

            // Update the fixture
            UpdateFixtureAction::run($fixture, [
                'host_fc_goals' => $scores['hostGoals'],
                'guest_fc_goals' => $scores['guestGoals'],
                'played_at' => now(),
            ]);
        }
    }
}
