<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application's landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
