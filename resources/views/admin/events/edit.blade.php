@extends('layouts.app')

@section('title', 'Edit event')
@section('description', 'Update the details of an existing event.')

@section('content')
    <div class="page-heading">
        <div>
            <a href="{{ route('admin.events.index') }}" class="link-primary text-decoration-none small">&larr; Back to events</a>
            <span class="eyebrow d-block mt-3">Admin calendar</span>
            <h1>Edit event</h1>
            <p>Update the event details shown on the public calendar.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            @include('admin.events.form', [
                'event' => $event,
                'action' => route('admin.events.update', $event),
                'method' => 'PUT',
            ])
        </div>
    </div>
@endsection
