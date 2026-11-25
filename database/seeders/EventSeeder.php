<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'name' => 'Laravel Beginners Workshop',
            'event_date' => now()->addDays(7)->toDateString(),
            'description' => 'A hands-on introduction to building web apps with Laravel.',
        ]);
        Event::create([
            'name' => 'Web Design with Bootstrap',
            'event_date' => now()->addDays(14)->toDateString(),
            'description' => 'Learn to build responsive pages quickly using Bootstrap.',
        ]);
        Event::create([
            'name' => 'Career Talk: Becoming a Full-Stack Developer',
            'event_date' => now()->addDays(21)->toDateString(),
            'description' => 'Industry speakers share how to start a developer career.',
        ]);
    }
}
