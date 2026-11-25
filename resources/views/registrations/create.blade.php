@extends('layouts.app')

@section('title', 'Register for '. $event->name)
@section('description', 'Register for '. $event->name .' in a few simple steps.')

@section('content')
    <div class="page-heading">
        <div>
            <a href="{{ route('events.index') }}" class="link-primary text-decoration-none small">&larr; Back to events</a>
            <span class="eyebrow d-block mt-3">Event registration</span>
            <h1>Reserve your spot.</h1>
            <p>Fill in your details below. Your place is confirmed as soon as the form is submitted.</p>
        </div>
    </div>

    <div class="row g-4 align-items-start">
        <div class="col-lg-7">
            <div class="form-card surface-card">
                <form id="registerForm" method="POST" action="{{ route('registrations.store', $event) }}">
                    @csrf

                    <div class="mb-4">
                        <span class="eyebrow">Step 1 of 1</span>
                        <h2 class="h4 mt-1 mb-1">Your details</h2>
                        <p class="text-muted mb-4">Use an email address you can access, as it appears on your confirmation.</p>
                    </div>

                    <div class="mb-3">
                        <label for="event" class="form-label">Event</label>
                        <input id="event" type="text" class="form-control" value="{{ $event->name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Full name <span class="required-mark" aria-hidden="true">*</span></label>
                        <input type="text" name="name" id="name" autocomplete="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email address <span class="required-mark" aria-hidden="true">*</span></label>
                        <input type="email" name="email" id="email" autocomplete="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">One registration per email address for each event.</div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="submit" id="submitBtn" class="btn btn-primary px-4">
                            <span class="button-label">Complete registration</span>
                            <span class="spinner-border spinner-border-sm ms-2 d-none" aria-hidden="true"></span>
                        </button>
                        <a href="{{ route('events.index') }}" class="btn btn-link text-decoration-none">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <aside class="summary-panel">
                <span class="eyebrow">You are registering for</span>
                <h2 class="h4 mt-2 mb-3">{{ $event->name }}</h2>
                <p class="text-muted">{{ $event->description }}</p>

                <div class="mt-4">
                    <div class="summary-row">
                        <span>Date</span>
                        <strong>{{ $event->event_date->format('l, d M Y') }}</strong>
                    </div>
                    <div class="summary-row">
                        <span>Status</span>
                        <span class="status-pill status-open">Open</span>
                    </div>
                    <div class="summary-row">
                        <span>Confirmation</span>
                        <strong>Immediate</strong>
                    </div>
                </div>

                <div class="mt-4 pt-1">
                    <span class="eyebrow">What happens next</span>
                    <ul class="step-list mt-3">
                        <li><span class="step-number">1</span> Submit your name and email address.</li>
                        <li><span class="step-number">2</span> Review your confirmation details instantly.</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('registerForm').addEventListener('submit', function () {
            var button = document.getElementById('submitBtn');
            button.disabled = true;
            button.querySelector('.button-label').textContent = 'Submitting...';
            button.querySelector('.spinner-border').classList.remove('d-none');
        });
    </script>
@endpush
