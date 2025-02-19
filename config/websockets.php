<?php

return [
    'apps' => [
        [
            'id' => env('PUSHER_APP_ID', 'notification_system'),
            'name' => 'Notification System',
            'key' => env('PUSHER_APP_KEY', 'notification_key'),
            'secret' => env('PUSHER_APP_SECRET', 'notification_secret'),
            'path' => env('PUSHER_APP_PATH', '/ws'),
            'capacity' => 1000,
            'enable_client_messages' => true,
            'enable_statistics' => true,
        ],
    ],

    'max_connections' => 1000,
    'heartbeat_interval' => 60,
    'connection_timeout' => 30,
    'ping_timeout' => 30,
];