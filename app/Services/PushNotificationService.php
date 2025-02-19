<?php

namespace App\Services;

use App\Models\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;

class PushNotificationService
{
    private $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function send(Notification $notification)
    {
        $user = $notification->user;
        $deviceToken = $user->device_token; // Assume user has a device token

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification([
                'title' => $notification->title,
                'body' => $notification->message
            ])
            ->withData($notification->data);

        $this->messaging->send($message);
    }
}