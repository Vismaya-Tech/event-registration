<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    // Shows the form
    public function create(Event $event)
    {
        abort_if($event->event_date->isBefore(today()), 404);

        return view('registrations.create', compact('event'));
    }

    // Receives the submitted form
    public function store(Request $request, Event $event)
    {
        abort_if($event->event_date->isBefore(today()), 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('registrations')->where(fn ($query) => $query->where('event_id', $event->id)),
            ],
        ]);

        $registration = $event->registrations()->create($validated);

        return redirect()->route('registrations.success', $registration);
    }

    // Shows the confirmation page
    public function success(Registration $registration)
    {
        $registration->load('event');

        return view('registrations.success', compact('registration'));
    }
}
