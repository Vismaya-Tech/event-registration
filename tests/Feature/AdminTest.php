<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_sent_to_the_admin_login_page(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_non_admin_users_are_forbidden_from_admin_pages(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_log_in_and_manage_events(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $this->post(route('admin.login.submit'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get(route('admin.dashboard'))->assertOk();
        $this->get(route('admin.login'))->assertOk();
        $this->get(route('admin.events.create'))->assertOk();
        $this->get(route('registrations.create', Event::create([
            'name' => 'Public Event',
            'event_date' => now()->addDays(6)->toDateString(),
            'description' => 'Open.',
        ])))->assertOk();

        $this->post(route('admin.events.store'), [
            'name' => 'New Event',
            'event_date' => now()->addDays(7)->toDateString(),
            'description' => 'Created by admin.',
        ])->assertRedirect(route('admin.events.index'));

        $event = Event::where('name', 'New Event')->firstOrFail();

        $this->get(route('admin.events.index'))->assertSee('New Event');
        $this->get(route('admin.events.edit', $event))->assertOk();

        $this->put(route('admin.events.update', $event), [
            'name' => 'Updated Event',
            'event_date' => now()->addDays(8)->toDateString(),
            'description' => 'Updated by admin.',
        ])->assertRedirect(route('admin.events.index'));

        $this->assertDatabaseHas('events', ['name' => 'Updated Event']);

        $this->delete(route('admin.events.destroy', $event))
            ->assertRedirect(route('admin.events.index'));

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    public function test_admin_can_view_registrations(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $event = Event::create([
            'name' => 'Workshop',
            'event_date' => now()->addDays(5)->toDateString(),
            'description' => 'Hands-on session.',
        ]);

        $event->registrations()->create(['name' => 'Jane Doe', 'email' => 'jane@example.com']);

        $this->actingAs($admin)
            ->get(route('admin.registrations.index'))
            ->assertOk()
            ->assertSee('Jane Doe')
            ->assertSee('Workshop');
    }
}
