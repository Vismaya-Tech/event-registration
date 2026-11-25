@extends('layouts.app')

@section('title', 'Upcoming Events')
@section('description', 'Browse upcoming events and reserve your place in a few simple steps.')

@section('content')
    <section class="hero mb-5">
        <div class="hero-copy">
            <span class="eyebrow">Discover what is next</span>
            <h1>Find your next great event.</h1>
            <p>Explore upcoming gatherings, reserve a spot, and get confirmed in minutes. No queues, no paperwork, just a simple registration flow.</p>

            <div class="hero-stats">
                <div class="hero-stat">
                    <strong>{{ $events->count() }}</strong>
                    <span>{{ $events->count() === 1 ? 'event' : 'events' }}} open</span>
                </div>
                <div class="hero-stat">
                    <strong>2 steps</strong>
                    <span>to register</span>
                </div>
                <div class="hero-stat">
                    <strong>Instant</strong>
                    <span>confirmation</span>
                </div>
            </div>
        </div>
    </section>

    <div class="section-heading">
        <div>
            <span class="eyebrow">Event calendar</span>
            <h2>Upcoming events</h2>
            <p>Choose an event below to complete your registration.</p>
        </div>
    </div>

    @if ($events->isNotEmpty())
        <div class="row g-4">
            @foreach ($events as $event)
                <div class="col-md-6 col-xl-4">
                    <article class="event-card surface-card h-100">
                        <div class="event-card-body">
                            <div class="event-top">
                                <div class="date-tile" aria-label="{{ $event->event_date->format('d F Y') }}">
                                    <strong>{{ $event->event_date->format('d') }}</strong>
                                    <span>{{ $event->event_date->format('M') }}</span>
                                </div>
                                <div>
                                    <h3 class="event-title">{{ $event->name }}</h3>
                                    <p class="event-meta">{{ $event->event_date->format('l, d F Y') }}</p>
                                </div>
                            </div>

                            <p class="event-description">{{ $event->description }}</p>
                        </div>

                        <div class="event-footer">
                            <span>Registration open</span>
                            <a href="{{ route('registrations.create', $event) }}" class="btn btn-sm btn-primary">
                                Register <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    @else
        <div class="surface-card empty-state">
            <div class="empty-icon" aria-hidden="true">&#9678;</div>
            <h3>No upcoming events right now.</h3>
            <p>Please check back soon. New events are added here as soon as they are published.</p>
        </div>
    @endif
@endsection
