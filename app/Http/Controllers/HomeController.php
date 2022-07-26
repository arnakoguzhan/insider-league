<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Actions\Simulation\CreateNewSimulation;
use App\Models\Team;

class HomeController extends Controller
{
    /**
     * Show the application's landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get all teams
        $teams = Team::all();

        return Inertia::render('Home', compact('teams'));
    }

    /**
     * Create a new simulation, fixtures and standings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function generateSimulation()
    {
        // Create a new simulation.
        $simulation = CreateNewSimulation::run();

        return redirect()->route('fixtures', $simulation->uid);
    }
}
