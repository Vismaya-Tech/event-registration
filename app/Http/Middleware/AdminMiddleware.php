<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check whether the user is logged in
        if (! auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Check whether the logged-in user is an admin
        if (! auth()->user()->is_admin) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
