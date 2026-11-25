<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'events' => Event::count(),
            'upcoming' => Event::where('event_date', '>=', today())->count(),
            'registrations' => Registration::count(),
            'thisWeek' => Registration::where('created_at', '>=', now()->subDays(7))->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->is_admin) {

                $request->session()->regenerate();

                return redirect()->route('admin.dashboard');
            }

            Auth::logout();

            return back()->withErrors([
                'email' => 'You are not authorized as an admin.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
