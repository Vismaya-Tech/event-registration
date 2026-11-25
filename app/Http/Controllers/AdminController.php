<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function events()
    {
        $events = Event::withCount('registrations')
            ->orderBy('event_date')
            ->get();

        return view('admin.events.index', compact('events'));
    }

    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('status', 'Event created.');
    }

    public function editEvent(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'description' => ['required', 'string'],
        ]);

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('status', 'Event updated.');
    }

    public function destroyEvent(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('status', 'Event deleted.');
    }

    public function registrations(Request $request)
    {
        $events = Event::orderBy('event_date')->get();

        $registrations = Registration::with('event')
            ->when($request->query('event_id'), fn ($query, $eventId) => $query->where('event_id', $eventId))
            ->latest()
            ->get();

        return view('admin.registrations.index', compact('registrations', 'events'));
    }
}
