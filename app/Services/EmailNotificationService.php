<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Mail;

class EmailNotificationService
{
    public function send(Notification $notification)
    {
        $user = $notification->user;

        Mail::send('emails.notification', ['notification' => $notification], function ($message) use ($user, $notification) {
            $message->to($user->email)
                    ->subject($notification->title);
        });
    }
}