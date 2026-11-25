
<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

// Visitor routes
Route::get('/', [EventController::class, 'index'])->name('events.index');

Route::get('/events/{event}/register', [RegistrationController::class, 'create'])
    ->name('registrations.create');

Route::post('/events/{event}/register', [RegistrationController::class, 'store'])
    ->name('registrations.store');

Route::get('/registrations/{registration}/success', [RegistrationController::class, 'success'])
    ->name('registrations.success');

// Admin login routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

// Protected admin routes
Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');

    Route::get('/events', [AdminController::class, 'events'])
        ->name('admin.events.index');

    Route::get('/events/create', [AdminController::class, 'createEvent'])
        ->name('admin.events.create');

    Route::post('/events', [AdminController::class, 'storeEvent'])
        ->name('admin.events.store');

    Route::get('/events/{event}/edit', [AdminController::class, 'editEvent'])
        ->name('admin.events.edit');

    Route::put('/events/{event}', [AdminController::class, 'updateEvent'])
        ->name('admin.events.update');

    Route::delete('/events/{event}', [AdminController::class, 'destroyEvent'])
        ->name('admin.events.destroy');

    Route::get('/registrations', [AdminController::class, 'registrations'])
        ->name('admin.registrations.index');
});
