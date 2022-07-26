<?php

namespace Tests\Feature;

use App\Models\Simulation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia as Assert;

class FixturesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_fixtures_page()
    {
        $simulation = Simulation::factory()->create();

        $this->get(route('fixtures', $simulation->uid))
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Fixtures')
                    ->url(route('fixtures', $simulation->uid, false))
                    ->has('fixtures')
                    ->has('simulationUid')
            );
    }
}
