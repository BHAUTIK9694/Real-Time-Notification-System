<?php

use App\Http\Controllers\NotificationController;

Route::middleware(['auth'])->group(function () {
    // Send notification (admin only)
    Route::post('/notifications/send', [NotificationController::class, 'sendNotification'])
        ->middleware('admin');
    
    // List user's notifications
    Route::get('/notifications', [NotificationController::class, 'listNotifications']);
    
    // Mark notification as read
    Route::put('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
});