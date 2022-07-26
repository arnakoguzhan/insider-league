<?php

namespace App\Http\Controllers;

use App\Actions\Simulation\PlayWeekAction;
use App\Actions\Simulation\ResetSimulationAction;
use App\Models\Simulation;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    /**
     * Play the next week of the simulation.
     * 
     * @param \App\Models\Simulation $simulation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function playWeek(Simulation $simulation)
    {
        // Get the next week's fixture for the simulation
        $nextFixture = $simulation->nextFixture();

        // Play the next week
        PlayWeekAction::run($nextFixture);

        return redirect()->route('standings', $simulation->uid);
    }

    /**
     * Play the all weeks of the simulation.
     * 
     * @param \App\Models\Simulation $simulation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function playAll(Simulation $simulation)
    {
        // Loop through all weeks
        foreach ($simulation->fixtures as $fixture) {
            // Play the fixture
            PlayWeekAction::run($fixture);
        }

        return redirect()->route('fixtures', $simulation->uid);
    }

    /**
     * Reset the simulation.
     * 
     * @param \App\Models\Simulation $simulation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reset(Simulation $simulation)
    {
        // Reset the simulation
        ResetSimulationAction::run($simulation);

        return redirect()->route('standings', $simulation->uid);
    }
}
