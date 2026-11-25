@extends('layouts.app')

@section('title', 'Admin login')
@section('description', 'Sign in to manage events and registrations.')

@section('content')
    <div class="auth-wrap">
        <div class="auth-card surface-card">
            <div class="auth-aside">
                <a class="brand" href="{{ route('events.index') }}">
                    <span class="brand-mark">E</span>
                    <span class="brand-name">Event<span>ly</span></span>
                </a>

                <div class="mt-5 pt-5">
                    <span class="eyebrow text-white-50">Administrator access</span>
                    <h2>Manage every event from one place.</h2>
                    <p>Create events, track registrations, and keep your event calendar up to date.</p>
                </div>

                <p class="small text-white-50 mb-0 mt-5">Secure area for authorised administrators only.</p>
            </div>

            <div class="auth-panel">
                <span class="eyebrow">Welcome back</span>
                <h1>Sign in to admin</h1>
                <p>Use your administrator account to continue.</p>

                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-start gap-2 mb-4" role="alert">
                        <span aria-hidden="true">&#33;</span>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" id="email" autocomplete="username"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" autocomplete="current-password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </form>

                <div class="mt-4 text-center">
                    <a href="{{ route('events.index') }}" class="small text-decoration-none">&larr; Back to events</a>
                </div>
            </div>
        </div>
    </div>
@endsection
