<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Attendee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = Event::all();
        $attendees = [
            [
                'name' => 'Ram Das',
                'email' => 'ram@gmail.com',
            ],
            [
                'name' => 'Ethic Williams',
                'email' => 'williams@gmail.com',
            ],
            [
                'name' => 'Neha Jha',
                'email' => 'njha@gmail.com',
            ],
        ];

        foreach ($attendees as $attendeeData) {
            // Loop through each attendee and assign them to the event
            $randomEvent = $events->random();
                Attendee::create([
                    'name' => $attendeeData['name'],
                    'email' => $attendeeData['email'],
                    'event_id' => $randomEvent->id,
                ]);
            }
        }
    }

