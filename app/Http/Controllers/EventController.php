<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Date;

class EventController extends Controller
{
    /**
     * @return View
     */
   public function index(): View
   {
       $events = Event::whereDoesntHave('registeredUsers')->get();

       return view('events.index', compact('events'));
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     */
    public function signup(Event $event): RedirectResponse
    {
        $user = auth()->user();

        if ($user->registeredEvents->contains($event->id)) {
            return redirect()->back()->with('error', 'You are already signed up for this event.');
        }

        $user->registeredEvents()->attach($event->id);

        return redirect()->back()->with('success', 'Successfully signed up for the event.');
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     */
    public function cancel(Event $event): RedirectResponse
    {
        $user = auth()->user();
        $isRegistered = $user->registeredEvents()->where('event_id', $event->id)->exists();

        if (!$isRegistered) {
            return redirect()->back()->with('error', 'You are not signed up for this event.');
        }

        $user->registeredEvents()->detach($event->id);

        return redirect()->back()->with('success', 'You have successfully canceled your signup for the event.');
    }

    /**
     * @return View
     */
    public function create(): View
    {
        if (!auth()->user()->isTrainer() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        return view('events.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (!auth()->user()->isTrainer() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'event_date' => 'required|date|after:now',
        ]);

        Event::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'author_id' => auth()->id(),
            'trainer_id' => auth()->id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully!');
    }

}
