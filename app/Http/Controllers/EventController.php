<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('event_date', '>=', today())
            ->orderBy('event_date')
            ->get();

        return view('events.index', compact('events'));
    }
}
