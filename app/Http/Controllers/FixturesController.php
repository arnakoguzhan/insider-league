<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return view('fixtures', compact('fixtures'));
    }
}
