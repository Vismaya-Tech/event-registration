@extends('layouts.app')

@section('title', 'Admin dashboard')
@section('description', 'Manage events and registrations from the admin dashboard.')

@section('content')
    <div class="page-heading">
        <div>
            <span class="eyebrow">Admin overview</span>
            <h1>Welcome back, {{ auth()->user()->name }}.</h1>
            <p>Here is a quick view of your events and registrations.</p>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#9635;</div>
            <div>
                <span>Total events</span>
                <strong>{{ $stats['events'] }}</strong>
            </div>
        </div>
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#9678;</div>
            <div>
                <span>Upcoming events</span>
                <strong>{{ $stats['upcoming'] }}</strong>
            </div>
        </div>
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#9679;</div>
            <div>
                <span>Registrations</span>
                <strong>{{ $stats['registrations'] }}</strong>
            </div>
        </div>
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#8599;</div>
            <div>
                <span>New this week</span>
                <strong>{{ $stats['thisWeek'] }}</strong>
            </div>
        </div>
    </div>

    <div class="surface-card p-4 p-lg-5">
        <span class="eyebrow">Quick actions</span>
        <h2 class="h5 mt-1 mb-4">What would you like to do?</h2>

        <div class="action-grid">
            <a href="{{ route('admin.events.create') }}" class="action-card">
                <span class="stat-icon" aria-hidden="true">&#43;</span>
                <strong>Create an event</strong>
                <span>Add a new event to the public calendar.</span>
            </a>
            <a href="{{ route('admin.events.index') }}" class="action-card">
                <span class="stat-icon" aria-hidden="true">&#9636;</span>
                <strong>Manage events</strong>
                <span>Edit event details or remove old listings.</span>
            </a>
            <a href="{{ route('admin.registrations.index') }}" class="action-card">
                <span class="stat-icon" aria-hidden="true">&#9776;</span>
                <strong>View registrations</strong>
                <span>Review attendees and filter by event.</span>
            </a>
            <a href="{{ route('events.index') }}" class="action-card">
                <span class="stat-icon" aria-hidden="true">&#8599;</span>
                <strong>Public event list</strong>
                <span>See what visitors currently see.</span>
            </a>
        </div>
    </div>
@endsection
