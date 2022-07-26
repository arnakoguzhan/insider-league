<?php

namespace App\Actions\Fixture;

use App\Models\Fixture;
use App\Models\Standing;
use App\Traits\AsAction;

class UpdateFixtureAction
{
    use AsAction;

    public function handle(Fixture $fixture, array $data)
    {
        // Check if we are updating played fixture
        $isAlreadyPlayed = $fixture->isPlayed();
        $oldHostGoals = $fixture->host_fc_goals;
        $oldGuestGoals = $fixture->guest_fc_goals;

        // Update fixture with new data
        $fixture->update($data);

        // Get standings for both host and guest teams
        $hostStanding = Standing::bySimulation($fixture->simulation_id)->byTeam($fixture->host_fc_id)->first();
        $guestStanding = Standing::bySimulation($fixture->simulation_id)->byTeam($fixture->guest_fc_id)->first();

        // Get the status of the fixture
        $status = 'DRAW';
        if ($fixture->host_fc_goals > $fixture->guest_fc_goals) {
            $status = 'HOST_WIN';
        } else if ($fixture->host_fc_goals < $fixture->guest_fc_goals) {
            $status = 'GUEST_WIN';
        }

        // Check if the fixture is already played, and we are updating the scores manually
        if ($isAlreadyPlayed) {
            // Host team won before, but now the guest team won
            if ($oldHostGoals > $oldGuestGoals && $status == 'GUEST_WIN') {
                $this->swapWinnerTeam($hostStanding, $guestStanding);
            }

            // Guest team won before, but now the host team won
            if ($oldGuestGoals > $oldHostGoals && $status == 'HOST_WIN') {
                $this->swapWinnerTeam($guestStanding, $hostStanding);
            }

            // Any team won before, but now draw
            if ($oldHostGoals != $oldGuestGoals && $status == 'DRAW') {
                if ($oldGuestGoals > $oldHostGoals) {
                    // If guest team won before the draw
                    $this->swapWinToDraw($guestStanding, $hostStanding);
                } else if ($oldHostGoals > $oldGuestGoals) {
                    // If host team won before the draw
                    $this->swapWinToDraw($hostStanding, $guestStanding);
                }
            }

            // If draw before and now it's not draw
            if ($oldHostGoals == $oldGuestGoals && $status != 'DRAW') {
                if ($status == 'HOST_WIN') {
                    // Host team won
                    $this->swapDrawToWin($hostStanding, $guestStanding);
                } else if ($status == 'GUEST_WIN') {
                    // Guest team won
                    $this->swapDrawToWin($guestStanding, $hostStanding);
                }
            }
        } else {
            // Update host's standings
            $hostStatus = $status == 'HOST_WIN' ? 'WIN' : ($status == 'DRAW' ? 'DRAW' : 'LOST');
            $this->updateStandingByStatus($hostStanding, $hostStatus);

            // Update guests's standings
            $guestStatus = $status == 'GUEST_WIN' ? 'WIN' : ($status == 'DRAW' ? 'DRAW' : 'LOST');
            $this->updateStandingByStatus($guestStanding, $guestStatus);
        }

        return $fixture;
    }

    public function swapWinToDraw($winnerStanding, $lostStanding)
    {
        $winnerStanding->update([
            'draw' => $winnerStanding->draw + 1,
            'won' => $winnerStanding->won - 1,
            'points' => $winnerStanding->points - 2,
        ]);

        $lostStanding->update([
            'draw' => $lostStanding->draw + 1,
            'lost' => $lostStanding->lost - 1,
            'points' => $lostStanding->points + 1,
        ]);
    }

    public function swapDrawToWin($winnerStanding, $lostStanding)
    {
        $winnerStanding->update([
            'draw' => $winnerStanding->draw - 1,
            'won' => $winnerStanding->won + 1,
            'points' => $winnerStanding->points + 2,
        ]);

        $lostStanding->update([
            'draw' => $lostStanding->draw - 1,
            'lost' => $lostStanding->lost + 1,
            'points' => $lostStanding->points - 1,
        ]);
    }

    public function updateStandingByStatus($standing, $status, $isPlayed = false)
    {
        // Update standing by given status
        $standing->update([
            'played' => $isPlayed ? $standing->played : $standing->played + 1,
            'won' => $status == 'WIN' ? $standing->won + 1 : $standing->won,
            'draw' => $status == 'DRAW' ? $standing->draw + 1 : $standing->draw,
            'lost' => $status == 'LOST' ? $standing->lost + 1 : $standing->lost,
            'points' => $status == 'WIN' ? $standing->points + 3 : ($status == 'DRAW' ? $standing->points + 1 : $standing->points),
        ]);
    }

    public function swapWinnerTeam($oldWinnerStanding, $newWinnerStanding)
    {
        // Reduce old winner team standing
        $oldWinnerStanding->update([
            'won' => $oldWinnerStanding->won - 1,
            'lost' => $oldWinnerStanding->lost + 1,
            'points' => $oldWinnerStanding->points - 3,
        ]);

        // Increase new winner team standing
        $newWinnerStanding->update([
            'won' => $newWinnerStanding->won + 1,
            'lost' => $newWinnerStanding->lost - 1,
            'points' => $newWinnerStanding->points + 3,
        ]);
    }
}
