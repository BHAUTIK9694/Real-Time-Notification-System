<?php

namespace App\Services;

use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class FirebaseNotificationService
{
    private $messaging;

    public function __construct()
    {
        $this->messaging = app(Messaging::class);
    }

    public function sendNotification($deviceToken, $title, $body, $data = [])
    {
        $notification = FirebaseNotification::create($title, $body);

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification)
            ->withData($data);

        try {
            $this->messaging->send($message);
            return true;
        } catch (\Exception $e) {
            \Log::error('Firebase Notification Failed', [
                'error' => $e->getMessage(),
                'device_token' => $deviceToken
            ]);
            return false;
        }
    }
}