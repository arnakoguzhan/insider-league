<?php

namespace Tests\Unit;

use App\Actions\Standing\FillWinChanceAttributeAction;
use App\Models\Simulation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FillWinChanceAttributeActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fill_win_chance_attribute_action()
    {
        $simulation = Simulation::factory()->create();

        // Calculate the win chance for each week
        for ($i = 1; $i < 7; $i++) {
            $standings = FillWinChanceAttributeAction::run($simulation, $simulation->standings);
            $simulation->nextFixture()->each(function ($fixture) {
                $fixture->played_at = now();
                $fixture->save();
            });
        }
    }
}
