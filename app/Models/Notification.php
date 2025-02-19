<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'notifications';

    protected $fillable = [
        'user_id', 'type', 'title', 'message', 
        'data', 'is_read', 'channel', 'expires_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'data' => 'array',
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead()
    {
        $this->is_read = true;
        $this->save();
    }

    public static function createNotification($userId, $type, $title, $message, $channel = 'websocket', $data = [])
    {
        return self::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'channel' => $channel,
            'data' => $data,
            'is_read' => false,
            'expires_at' => now()->addDays(30)
        ]);
    }
}