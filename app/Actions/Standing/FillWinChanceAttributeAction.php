<?php

namespace App\Actions\Standing;

use App\Models\Simulation;
use App\Traits\AsAction;
use Illuminate\Support\Collection;

class FillWinChanceAttributeAction
{
    use AsAction;

    public function handle(Simulation $simulation, Collection $standings)
    {
        // Get first team who have the most points
        $firstTeamStanding = $standings->first();

        // Weeks left to play
        $weeksLeft = 6 - $firstTeamStanding->played;

        // Get unplayed fixtures
        $unplayedFixtures = $simulation->getUnplayedFixtures();

        // Sum of the chance
        $sumChance = 0;

        // Iterate through all standings and fill win chance attribute
        foreach ($standings as $key => $standing) {
            // Get the current position in the standings
            $currentPosition = $key + 1;

            // Return 'na' if less than 4 games played or the simulation is completed
            if ($standing->played < 4 || !$weeksLeft) {
                $standing->winChance = -1;
                continue;
            }

            // Check if there is no chance to win by any team, if the first team has more points than other team's maximum possible points
            $maxPointsForStanding = $standing->points + (3 * $weeksLeft);
            if ($firstTeamStanding != $standing && $firstTeamStanding->points > $maxPointsForStanding) {
                $standing->winChance = 0;
                continue;
            }

            // Calculate change
            $changeToWin = 0;
            foreach ($unplayedFixtures as $fixture) {
                // If the current team is the home team of the fixture
                // increase change by 2
                if ($fixture->host_fc_id == $standing->team->id) {
                    $changeToWin += 2;
                }

                // If the current team is the guest team of the fixture
                // increase change by 1
                if ($fixture->guest_fc_id == $standing->team->id) {
                    $changeToWin += 1;
                }
            }

            $chanceWithCurrentPosition = $changeToWin - ($currentPosition / 2);
            $chanceWithPointsDifference = $chanceWithCurrentPosition - (($firstTeamStanding->points - $standing->points) / 2);

            if ($chanceWithPointsDifference > 0) {
                $standing->winChance = $chanceWithPointsDifference;
                $sumChance += $chanceWithPointsDifference;
                continue;
            }

            if ($currentPosition == 1 && empty($unplayedFixtures)) {
                $standing->winChance = abs($chanceWithPointsDifference);
                $sumChance += abs($chanceWithPointsDifference);
                continue;
            }
        }

        // Division by zero check
        $onePointPercentValue = 100 / ($sumChance ?: 0.1);

        foreach ($standings as $standing) {
            if ($standing->winChance != -1 && $standing->winChance != 0) {
                $standing->winChance = round($standing->winChance * $onePointPercentValue,  2);
            }
        }

        return $standings;
    }
}
