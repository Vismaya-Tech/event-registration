@extends('layouts.app')

@section('title', 'Manage events')
@section('description', 'Create, edit, and manage events from the admin area.')

@section('content')
    <div class="page-heading">
        <div>
            <span class="eyebrow">Admin calendar</span>
            <h1>Manage events</h1>
            <p>Keep the event calendar current and monitor registration numbers.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">New event</a>
    </div>

    <div class="stat-grid">
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#9635;</div>
            <div>
                <span>Total events</span>
                <strong>{{ $events->count() }}</strong>
            </div>
        </div>
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#9678;</div>
            <div>
                <span>Upcoming</span>
                <strong>{{ $events->where('event_date', '>=', today())->count() }}</strong>
            </div>
        </div>
        <div class="stat-card surface-card">
            <div class="stat-icon" aria-hidden="true">&#9679;</div>
            <div>
                <span>Total registrations</span>
                <strong>{{ $events->sum('registrations_count') }}</strong>
            </div>
        </div>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-center">Registrations</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="date-tile" aria-hidden="true">
                                        <strong>{{ $event->event_date->format('d') }}</strong>
                                        <span>{{ $event->event_date->format('M') }}</span>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $event->name }}</div>
                                        <div class="small text-muted">{{ $event->description }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap">{{ $event->event_date->format('l, d M Y') }}</td>
                            <td>
                                <span class="status-pill {{ $event->event_date->gte(today()) ? 'status-open' : 'status-past' }}">
                                    {{ $event->event_date->gte(today()) ? 'Upcoming' : 'Past' }}
                                </span>
                            </td>
                            <td class="text-center"><span class="count-pill">{{ $event->registrations_count }}</span></td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="d-inline"
                                      onsubmit="return confirm('Delete this event and its registrations?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon" aria-hidden="true">&#9678;</div>
                                    <h3>No events yet</h3>
                                    <p>Create your first event to start accepting registrations.</p>
                                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">New event</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
