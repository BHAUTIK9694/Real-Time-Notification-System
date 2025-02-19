<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users
        $users = User::limit(5)->get();

        foreach ($users as $user) {
            // Create sample notifications
            Notification::create([
                'user_id' => $user->id,
                'type' => 'system',
                'title' => 'Welcome to Notification System',
                'message' => 'You have successfully registered!',
                'is_read' => false,
                'channel' => 'websocket',
                'data' => []
            ]);

            Notification::create([
                'user_id' => $user->id,
                'type' => 'event',
                'title' => 'Upcoming Event',
                'message' => 'You have an event scheduled next week.',
                'is_read' => false,
                'channel' => 'email',
                'data' => [
                    'event_date' => now()->addWeek()->toDateString(),
                    'event_location' => 'Online'
                ]
            ]);
        }
    }
}