<!DOCTYPE html>
<html>
<head>
    <title>{{ $notificationTitle }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .notification { background-color: #f4f4f4; padding: 15px; border-radius: 5px; }
        .type { font-weight: bold; color: #666; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="container">
        <div class="notification">
            <h2>{{ $notificationTitle }}</h2>
            <p class="type">{{ $notificationType }} Notification</p>
            <p>{{ $notificationMessage }}</p>
            
            @if(!empty($notificationData))
                <div>
                    <h3>Additional Details:</h3>
                    <ul>
                        @foreach($notificationData as $key => $value)
                            <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</body>
</html>