<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StandingController extends Controller
{
    /**
     * Show the standings for the given simulation.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Get standing data from the database

        return Inertia::render('Standings');
    }
}
