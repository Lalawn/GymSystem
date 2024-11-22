<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Date;

class EventController extends Controller
{
   public function index(){
       $events = Event::all();
       return view('events.index', compact('events'));
    }

    public function signup(Event $event)
    {
        $user = auth()->user();

        // Check if the user is already registered
        if ($user->registeredEvents->contains($event->id)) {
            return redirect()->back()->with('error', 'You are already signed up for this event.');
        }

        // Register the user for the event
        $user->registeredEvents()->attach($event->id);

        return redirect()->back()->with('success', 'Successfully signed up for the event.');
    }

    public function myRegisteredEvents()
    {
        $registeredEvents = auth()->user()->registeredEvents()->with('trainer')->get();
        return view('events.myEvents', compact('registeredEvents'));
    }

    public function cancel(Event $event)
    {
        $user = auth()->user();

        // Check if the user is registered for the event
        $isRegistered = $user->registeredEvents()->where('event_id', $event->id)->exists();

        if (!$isRegistered) {
            return redirect()->back()->with('error', 'You are not signed up for this event.');
        }

        // Remove the user from the event
        $user->registeredEvents()->detach($event->id);

        return redirect()->back()->with('success', 'You have successfully canceled your signup for the event.');
    }


}
