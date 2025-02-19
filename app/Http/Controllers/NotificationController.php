<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function sendNotification(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,_id',
            'type' => 'required|in:event,booking,system',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'channel' => 'in:websocket,email,push',
            'data' => 'sometimes|array'
        ]);

        // Send notification
        $notification = $this->notificationService->sendNotification($validatedData);

        return response()->json($notification, 201);
    }

    public function listNotifications()
    {
        $notifications = auth()->user()->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($notifications);
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Ensure user can only mark their own notifications
        $this->authorize('update', $notification);

        $notification->update(['is_read' => true]);

        return response()->json(['message' => 'Notification marked as read']);
    }
}