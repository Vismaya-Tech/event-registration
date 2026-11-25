<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $__env->yieldContent('description', 'Discover upcoming events and register in minutes.') }}">
    <meta name="theme-color" content="#4f46e5">
    <title>{{ $__env->yieldContent('title', 'Event Registration') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="app-shell">
    <header class="site-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container shell-container">
                <a class="brand" href="{{ route('events.index') }}">
                    <span class="brand-mark">E</span>
                    <span class="brand-name">Event<span>ly</span></span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                        aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}"
                               href="{{ route('events.index') }}">Events</a>
                        </li>

                        @auth
                            @if (auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                       href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}"
                                       href="{{ route('admin.events.index') }}">Manage events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}"
                                       href="{{ route('admin.registrations.index') }}">Registrations</a>
                                </li>
                                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">Log out</button>
                                    </form>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.login') }}">Admin login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="app-main">
        <div class="container shell-container py-5">
            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
                    <span aria-hidden="true">&#10003;</span>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="site-footer">
        <div class="container shell-container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <span>&copy; {{ now()->year }} Evently. All rights reserved.</span>
            <span>Simple events, smooth registrations.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    @stack('scripts')
</body>
</html>
