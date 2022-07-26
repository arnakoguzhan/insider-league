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
        // Update fixture
        $fixture->update($data);

        // Update host standing
        $hostStanding = Standing::bySimulation($fixture->simulation_id)->byTeam($fixture->host_fc_id)->first();
        $hostStanding->update([
            'played' => $hostStanding->played + 1,
            'won' => $hostStanding->won + ($fixture->host_fc_goals > $fixture->guest_fc_goals ? 1 : 0),
            'draw' => $hostStanding->draw + ($fixture->host_fc_goals == $fixture->guest_fc_goals ? 1 : 0),
            'lost' => $hostStanding->lost + ($fixture->host_fc_goals < $fixture->guest_fc_goals ? 1 : 0),
            'goal_difference' => $hostStanding->goal_difference + ($fixture->host_fc_goals - $fixture->guest_fc_goals),
            'points' => $hostStanding->points + ($fixture->host_fc_goals > $fixture->guest_fc_goals ? 3 : ($fixture->host_fc_goals == $fixture->guest_fc_goals ? 1 : 0)),
        ]);

        // Update guest standing
        $guestStanding = Standing::bySimulation($fixture->simulation_id)->byTeam($fixture->guest_fc_id)->first();
        $guestStanding->update([
            'played' => $guestStanding->played + 1,
            'won' => $guestStanding->won + ($fixture->guest_fc_goals > $fixture->host_fc_goals ? 1 : 0),
            'draw' => $guestStanding->draw + ($fixture->guest_fc_goals == $fixture->host_fc_goals ? 1 : 0),
            'lost' => $guestStanding->lost + ($fixture->guest_fc_goals < $fixture->host_fc_goals ? 1 : 0),
            'goal_difference' => $guestStanding->goal_difference + ($fixture->guest_fc_goals - $fixture->host_fc_goals),
            'points' => $guestStanding->points + ($fixture->guest_fc_goals > $fixture->host_fc_goals ? 3 : ($fixture->guest_fc_goals == $fixture->host_fc_goals ? 1 : 0)),
        ]);

        return $fixture;
    }
}
