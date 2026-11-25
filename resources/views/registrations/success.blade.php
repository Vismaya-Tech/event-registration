@extends('layouts.app')

@section('title', 'Registration confirmed')
@section('description', 'Your event registration has been confirmed.')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <div class="text-center mb-4">
                <div class="success-icon" aria-hidden="true">&#10003;</div>
                <span class="eyebrow">Registration confirmed</span>
                <h1 class="mt-2 mb-2">Thank you, {{ $registration->name }}!</h1>
                <p class="text-muted mb-0">Your spot is reserved. Here are the details for your records.</p>
            </div>

            <div class="surface-card overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-light border-end p-4 p-lg-5">
                        <span class="eyebrow">Event</span>
                        <h2 class="h4 mt-2 mb-3">{{ $registration->event->name }}</h2>
                        <p class="text-muted">{{ $registration->event->description }}</p>

                        <div class="date-tile mt-4" aria-label="{{ $registration->event->event_date->format('d F Y') }}">
                            <strong>{{ $registration->event->event_date->format('d') }}</strong>
                            <span>{{ $registration->event->event_date->format('M Y') }}</span>
                        </div>
                    </div>

                    <div class="col-md-7 p-4 p-lg-5">
                        <h3 class="h5 mb-4">Confirmation details</h3>

                        <div class="summary-row">
                            <span>Attendee</span>
                            <strong>{{ $registration->name }}</strong>
                        </div>
                        <div class="summary-row">
                            <span>Email address</span>
                            <strong>{{ $registration->email }}</strong>
                        </div>
                        <div class="summary-row">
                            <span>Event date</span>
                            <strong>{{ $registration->event->event_date->format('l, d F Y') }}</strong>
                        </div>
                        <div class="summary-row">
                            <span>Registered at</span>
                            <strong>{{ $registration->created_at->format('d M Y, H:i') }}</strong>
                        </div>
                        <div class="summary-row">
                            <span>Reference</span>
                            <strong>EVT-{{ str_pad((string) $registration->id, 6, '0', STR_PAD_LEFT) }}</strong>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <a href="{{ route('events.index') }}" class="btn btn-primary">Back to events</a>
                            <a href="{{ route('registrations.create', $registration->event) }}" class="btn btn-outline-secondary">Register someone else</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
