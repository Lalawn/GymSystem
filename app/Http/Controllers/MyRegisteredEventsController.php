<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MyRegisteredEventsController extends Controller
{
    /**
     * @return View
     */
    public function myRegisteredEvents(): View
    {
        $registeredEvents = auth()->user()->registeredEvents()->with('trainer')->get();
        return view('events.myEvents', compact('registeredEvents'));
    }
}
