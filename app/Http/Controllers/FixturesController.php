<?php

namespace App\Http\Controllers;

use App\Http\Resources\FixtureResource;
use App\Models\Simulation;
use Inertia\Inertia;

class FixturesController extends Controller
{
    /**
     * Show the fixtures for the given simulation.
     * 
     * @param  \App\Models\Simulation  $simulation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Simulation $simulation)
    {
        $fixtures = FixtureResource::collection($simulation->fixtures)->collection->groupBy('week');
        $simulationUid = $simulation->uid;

        return Inertia::render('Fixtures', compact('fixtures', 'simulationUid'));
    }
}
