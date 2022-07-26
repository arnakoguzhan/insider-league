<?php

namespace Tests\Feature;

use App\Models\Simulation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class StandingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_standings_page()
    {
        $simulation = Simulation::factory()->create();

        $this->get(route('standings', $simulation->uid))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Standings')
                    ->url(route('standings', $simulation->uid, false))
                    ->has('standings')
                    ->has('nextFixture')
                    ->has('lastPlayedFixture')
                    ->has('lastPlayedFixture')
                    ->has('simulationUid')
            );
    }
}
