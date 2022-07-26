<?php

namespace App\Http\Controllers;

use App\Actions\Standing\FillWinChanceAttributeAction;
use App\Http\Resources\FixtureResource;
use App\Http\Resources\StandingResource;
use App\Models\Simulation;
use Inertia\Inertia;

class StandingController extends Controller
{
    /**
     * Show the standings for the given simulation.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Simulation $simulation)
    {
        // Fill standing's with win chance attribute
        $standings = FillWinChanceAttributeAction::run($simulation, $simulation->standings);

        // Generate the fixtures response after the winChance attributes are filled
        $standings = StandingResource::collection($standings);

        // Get the next fixture for the simulation
        $nextFixture = FixtureResource::collection($simulation->nextFixture())->collection->groupBy('week');

        // Get the last played fixture if available for the simulation
        $lastPlayedFixture = FixtureResource::collection($simulation->lastPlayedFixture())->collection->groupBy('week');

        // Get the simulation uid for the view
        $simulationUid = $simulation->uid;

        return Inertia::render('Standings', compact('standings', 'nextFixture', 'lastPlayedFixture', 'simulationUid'));
    }
}
