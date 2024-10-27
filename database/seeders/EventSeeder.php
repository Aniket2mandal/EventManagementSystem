<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();

        // Create real events with meaningful details
        $events = [
            [
                'title' => 'photoshop Workshop',
                'description' => 'knowledge of photoshop and graphics design',
                'date' => '2024-11-15',
                'location' => 'chitwan',
                'category_id' => $categories->where('name', 'Workshop')->first()?->id,
            ],
            [
                'title' => 'IT conference',
                'description' => 'General conference of engineer',
                'date' => '2024-12-10',
                'location' => 'trishuli resort',
                'category_id' => $categories->where('name', 'Conference')->first()?->id,
            ],
            [
                'title' => 'management seminar',
                'description' => 'This seminar is focused on population management',
                'date' => '2024-11-25',
                'location' => 'Online',
                'category_id' => $categories->where('name', 'Seminar')->first()?->id,
            ],

            [
                'title' => 'Engineer conference',
                'description' => 'General conference of engineer',
                'date' => '2024-12-10',
                'location' => 'trishuli resort',
                'category_id' => $categories->where('name', 'Conference')->first()?->id,
            ],
            [
                'title' => 'Pollution management seminar',
                'description' => 'This seminar is focused on population management',
                'date' => '2024-11-25',
                'location' => 'Online',
                'category_id' => $categories->where('name', 'Seminar')->first()?->id,
            ],

        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
