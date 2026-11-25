<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_event_list_shows_only_upcoming_events(): void
    {
        Event::create([
            'name' => 'Upcoming Event',
            'event_date' => now()->addDays(3)->toDateString(),
            'description' => 'Open for registration.',
        ]);

        Event::create([
            'name' => 'Past Event',
            'event_date' => now()->subDays(3)->toDateString(),
            'description' => 'Already finished.',
        ]);

        $this->get(route('events.index'))
            ->assertOk()
            ->assertSee('Upcoming Event')
            ->assertDontSee('Past Event');
    }

    public function test_visitor_can_register_for_an_event(): void
    {
        $event = Event::create([
            'name' => 'Workshop',
            'event_date' => now()->addDays(5)->toDateString(),
            'description' => 'Hands-on session.',
        ]);

        $this->post(route('registrations.store', $event), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ])->assertSessionHasNoErrors();

        $registration = Registration::firstOrFail();

        $this->assertDatabaseHas('registrations', [
            'event_id' => $event->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);

        $this->get(route('registrations.success', $registration))
            ->assertOk()
            ->assertSee('Jane Doe')
            ->assertSee('Workshop');
    }

    public function test_the_same_email_cannot_register_twice_for_one_event(): void
    {
        $event = Event::create([
            'name' => 'Workshop',
            'event_date' => now()->addDays(5)->toDateString(),
            'description' => 'Hands-on session.',
        ]);

        $data = ['name' => 'Jane Doe', 'email' => 'jane@example.com'];

        $this->post(route('registrations.store', $event), $data)->assertSessionHasNoErrors();
        $this->post(route('registrations.store', $event), $data)->assertSessionHasErrors('email');

        $this->assertDatabaseCount('registrations', 1);
    }

    public function test_past_events_cannot_be_registered_for(): void
    {
        $event = Event::create([
            'name' => 'Old Event',
            'event_date' => now()->subDay()->toDateString(),
            'description' => 'Finished.',
        ]);

        $this->get(route('registrations.create', $event))->assertNotFound();
        $this->post(route('registrations.store', $event), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ])->assertNotFound();

        $this->assertDatabaseCount('registrations', 0);
    }
}
