@extends('layouts.app')

@section('title', 'Registrations')
@section('description', 'Review event registrations in the admin area.')

@section('content')
    <div class="page-heading">
        <div>
            <span class="eyebrow">Admin records</span>
            <h1>Registrations</h1>
            <p>Review attendees and filter the list by event.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to dashboard</a>
    </div>

    <div class="surface-card p-4 mb-4">
        <form method="GET" action="{{ route('admin.registrations.index') }}" class="row g-3 align-items-end">
            <div class="col-md-6 col-lg-5">
                <label for="event_id" class="form-label">Filter by event</label>
                <select name="event_id" id="event_id" class="form-select">
                    <option value="">All events</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" @selected(request('event_id') == $event->id)>
                            {{ $event->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Apply filter</button>
            </div>
            @if (request()->filled('event_id'))
                <div class="col-auto">
                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary">Clear</a>
                </div>
            @endif
            <div class="col-12">
                <span class="text-muted small">Showing <strong>{{ $registrations->count() }}</strong>
                    {{ $registrations->count() === 1 ? 'registration' : 'registrations' }}.</span>
            </div>
        </form>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Attendee</th>
                        <th>Event</th>
                        <th>Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar" aria-hidden="true">{{ mb_substr($registration->name, 0, 1) }}</div>
                                    <div>
                                        <div class="fw-bold">{{ $registration->name }}</div>
                                        <div class="small text-muted">{{ $registration->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $registration->event->name }}</span></td>
                            <td class="text-nowrap">{{ $registration->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <div class="empty-icon" aria-hidden="true">&#9776;</div>
                                    <h3>No registrations found</h3>
                                    <p>Try a different event filter, or check back once attendees have registered.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
