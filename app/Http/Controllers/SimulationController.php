<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationController extends Controller
{
    /**
     * Show the standings for the given simulation.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function playWeek(Request $request)
    {
        // Get standing data from the database
        return view('simulation', compact('fixtures'));
    }

    /**
     * Show the standings for the given simulation.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function playAll(Request $request)
    {
        // Get standing data from the database
        return view('simulation', compact('fixtures'));
    }

    /**
     * Show the standings for the given simulation.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reset(Request $request)
    {
        // Get standing data from the database
        return view('simulation', compact('fixtures'));
    }
}
