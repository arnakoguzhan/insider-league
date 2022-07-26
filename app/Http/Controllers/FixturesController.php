<?php

namespace App\Http\Controllers;

use App\Actions\Fixture\UpdateFixtureAction;
use App\Http\Resources\FixtureResource;
use App\Models\Fixture;
use App\Models\Simulation;
use Illuminate\Http\Request;
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
        // Get all fixtures for the simulation
        $fixtures = FixtureResource::collection($simulation->fixtures)->collection->groupBy('week');

        // Get the simulation uid for the view
        $simulationUid = $simulation->uid;

        return Inertia::render('Fixtures', compact('fixtures', 'simulationUid'));
    }

    /**
     * Update the given fixture.
     * 
     * @param  \App\Models\Simulation  $simulation
     * @param  \App\Models\Fixture  $fixture
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, Simulation $simulation, Fixture $fixture)
    {
        // Validate the request
        $request->validate([
            'editingHostGoals' => 'required|integer|min:0',
            'editingGuestGoals' => 'required|integer|min:0',
        ]);

        // Update fixture if values are changed
        if ($request->editingHostGoals != $fixture->host_fc_goals || $request->editingGuestGoals != $fixture->guest_fc_goals) {
            UpdateFixtureAction::run($fixture, [
                'host_fc_goals' => $request->editingHostGoals,
                'guest_fc_goals' => $request->editingGuestGoals,
            ]);
        }

        return redirect()->back();
    }
}
