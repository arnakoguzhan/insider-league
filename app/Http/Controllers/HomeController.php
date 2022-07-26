<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Actions\Fixture\GenerateNewFixtureAction;
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
        $teams = Team::all();

        return Inertia::render('Home', compact('teams'));
    }

    /**
     * Show the application's landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function generateFixtures()
    {
        // Create a new simulation.
        $simulation = CreateNewSimulation::run();

        // Generate the fixtures.
        GenerateNewFixtureAction::run($simulation);

        return redirect()->route('fixtures', [
            'simulation' => $simulation->uid,
        ]);
    }
}
