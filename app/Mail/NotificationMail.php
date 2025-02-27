<?php

namespace App\Mail;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function build()
    {
        return $this->subject($this->notification->title)
            ->view('emails.notification')
            ->with([
                'notificationTitle' => $this->notification->title,
                'notificationMessage' => $this->notification->message,
                'notificationType' => $this->notification->type,
                'notificationData' => $this->notification->data
            ]);
    }
}