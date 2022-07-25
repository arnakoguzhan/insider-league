<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FixturesController extends Controller
{
    /**
     * Show the fixtures for the given simulation.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Get fixture data from the database
        $fixture = $request->simulation;

        return Inertia::render('Fixtures', [
            'fixture' => $fixture,
        ]);
    }
}
