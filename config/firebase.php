<?php

return [
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS', storage_path('firebase_credentials.json')),
        'type' => env('FIREBASE_CREDENTIALS_TYPE', 'service_account'),
    ],

    'projects' => [
        'default' => [
            'project_id' => env('FIREBASE_PROJECT_ID'),
            'private_key' => env('FIREBASE_PRIVATE_KEY'),
            'client_email' => env('FIREBASE_CLIENT_EMAIL'),
        ],
    ],

    'topics' => [
        'general' => 'general_notifications',
        'urgent' => 'urgent_notifications',
    ],

    'default_topic' => 'general_notifications',
];