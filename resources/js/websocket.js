import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Listen for notifications
Echo.channel(`notifications.${userId}`)
    .listen('NotificationCreated', (event) => {
        // Update UI with new notification
        const notificationContainer = document.getElementById('notifications');
        const notificationElement = document.createElement('div');
        notificationElement.classList.add('notification', event.notification.type);
        notificationElement.innerHTML = `
            <h3>${event.notification.title}</h3>
            <p>${event.notification.message}</p>
            <small>${new Date(event.notification.created_at).toLocaleString()}</small>
        `;
        notificationContainer.prepend(notificationElement);

        // Optional: Play notification sound
        new Audio('/sounds/notification.mp3').play();

        // Optional: Browser notification
        if (Notification.permission === 'granted') {
            new Notification(event.notification.title, {
                body: event.notification.message
            });
        }
    });