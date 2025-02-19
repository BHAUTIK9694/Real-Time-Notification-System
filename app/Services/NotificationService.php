<?php

namespace App\Services;

use App\Models\Notification;
use App\Events\NotificationCreated;
use App\Models\User;

class NotificationService
{
    public function sendNotification(array $data)
    {
        // Validate recipient
        $user = User::findOrFail($data['user_id']);

        // Create notification
        $notification = Notification::create([
            'user_id' => $user->id,
            'type' => $data['type'],
            'title' => $data['title'],
            'message' => $data['message'],
            'data' => $data['data'] ?? [],
            'channel' => $data['channel'] ?? 'websocket',
            'is_read' => false
        ]);

        // Broadcast event
        event(new NotificationCreated($notification));

        // Send additional channel notifications
        $this->sendChannelNotifications($notification);

        return $notification;
    }

    private function sendChannelNotifications(Notification $notification)
    {
        // Email Notification
        if ($notification->channel === 'email') {
            $this->sendEmailNotification($notification);
        }

        // Push Notification
        if ($notification->channel === 'push') {
            $this->sendPushNotification($notification);
        }
    }

    private function sendEmailNotification(Notification $notification)
    {
        // Implement email sending logic
        \Mail::to($notification->user->email)->send(
            new \App\Mail\NotificationMail($notification)
        );
    }

    private function sendPushNotification(Notification $notification)
    {
        // Implement Firebase Cloud Messaging
        $firebaseService = new FirebaseNotificationService();
        $firebaseService->sendNotification(
            $notification->user->device_token, 
            $notification->title, 
            $notification->message
        );
    }
}