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

        // Sum of the chances for all teams
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

            // Improve the chance by being host or guest for unplayed fixtures
            $chanceToWin = 0;
            foreach ($unplayedFixtures as $fixture) {
                // If the current team is the home team of the fixture
                // increase change by 2
                if ($fixture->host_fc_id == $standing->team->id) {
                    $chanceToWin += 2;
                }

                // If the current team is the guest team of the fixture
                // increase change by 1
                if ($fixture->guest_fc_id == $standing->team->id) {
                    $chanceToWin += 1;
                }
            }

            // Improve the chance by current standing position
            $chanceToWin = ($chanceToWin - ($currentPosition / 2)) - (($firstTeamStanding->points - $standing->points) / 2);

            // Set the win chance attribute
            if ($chanceToWin > 0) {
                $standing->winChance = $chanceToWin;
                $sumChance += $chanceToWin;
                continue;
            }

            // Set the win chance attribute
            if ($currentPosition == 1 && empty($unplayedFixtures)) {
                $standing->winChance = abs($chanceToWin);
                $sumChance += abs($chanceToWin);
                continue;
            }
        }

        // Get a value (weight) for each point
        // Division by zero check
        $onePointPercentValue = 100 / ($sumChance ?: 0.1);

        // Iterate through all standings and fill win chance attribute again but as a percentage
        foreach ($standings as $standing) {
            if ($standing->winChance != -1 && $standing->winChance != 0) {
                $standing->winChance = round($standing->winChance * $onePointPercentValue,  2);
            }
        }

        // Return the standings with filled winChance attributes
        return $standings;
    }
}
