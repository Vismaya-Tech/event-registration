@extends('layouts.app')

@section('title', 'Create event')
@section('description', 'Add a new event to the public calendar.')

@section('content')
    <div class="page-heading">
        <div>
            <a href="{{ route('admin.events.index') }}" class="link-primary text-decoration-none small">&larr; Back to events</a>
            <span class="eyebrow d-block mt-3">Admin calendar</span>
            <h1>Create an event</h1>
            <p>Add the essentials now. You can update the details at any time.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-9">
            @include('admin.events.form', ['event' => null, 'action' => route('admin.events.store'), 'method' => 'POST'])
        </div>
    </div>
@endsection
