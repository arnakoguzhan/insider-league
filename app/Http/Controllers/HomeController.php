<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Show the application's landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return Inertia::render('Home');
    }

    /**
     * Show the application's landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function generateFixtures()
    {
        // Generate fixtures for the current simulation
        // TODO: Implement
        sleep(5);
        $random = rand(1, 100);

        return redirect()->route('fixtures', [
            'simulation' => $random,
        ]);
    }
}
