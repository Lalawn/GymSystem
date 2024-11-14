<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Date;

class EventController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getEvents(): JsonResponse{
        $events = Event::all();



        return response()->json($events->map(function ($event) {

            $formattedDate = Carbon::createFromTimestamp($event->event_date);

            return [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $event->event_date,
                'end' => Carbon::parse($event->event_date)->addHour()->format('Y-m-d\TH:i:s'),
            ];
        }));
    }
}
