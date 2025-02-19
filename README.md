# Real-Time Notification System

## Project Overview

A robust real-time notification system built with Laravel, featuring multi-channel notifications, WebSocket integration, and secure communication.

## Technical Specifications

### Core Technologies
- Backend Framework: Laravel 11
- Database: MongoDB
- Real-Time Communication: WebSockets
- Push Notifications: Firebase Cloud Messaging

## Repository Structure
```
notification-system/
│
├── app/                  # Laravel application core
│   ├── Http/             # Controllers and middleware
│   ├── Models/           # Data models
│   ├── Services/         # Business logic services
│   └── Events/           # WebSocket and notification events
│
├── config/               # Configuration files
│   ├── websockets.php    # WebSocket configuration
│   ├── firebase.php      # Firebase settings
│   └── logging.php       # Logging configurations
│
├── database/             # Database migrations and seeders
│   └── seeders/          # Initial data seeders
│
└── routes/               # API route definitions
```

## API Documentation

### Authentication Endpoints
| Method | Endpoint | Description | Authentication |
|--------|----------|-------------|----------------|
| POST | `/api/login` | User authentication | Public |
| POST | `/api/register` | User registration | Public |

### Notification Endpoints
| Method | Endpoint | Description | Authentication |
|--------|----------|-------------|----------------|
| POST | `/api/notifications/send` | Send a notification | Admin Only |
| GET | `/api/notifications` | List user notifications | Authenticated Users |
| PUT | `/api/notifications/{id}/mark-as-read` | Mark notification as read | Authenticated Users |

### Request Formats

#### Send Notification Request
```json
{
    "user_id": "string",
    "type": "string (event/booking/system)",
    "title": "string",
    "message": "string",
    "channel": "string (websocket/email/push)"
}
```

#### Notification Response
```json
{
    "id": "string",
    "type": "string",
    "title": "string",
    "message": "string",
    "is_read": "boolean",
    "created_at": "timestamp"
}
```

## Setup and Installation

### Prerequisites
- PHP 8.1+
- Composer
- Node.js
- MongoDB
- Firebase Account

### Installation Steps

1. Clone the Repository
```bash
git clone https://github.com/yourusername/notification-system.git
cd notification-system
```

2. Install Dependencies
```bash
composer install
npm install
```

3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

4. Database Setup
```bash
php artisan migrate:fresh
php artisan db:seed
```

5. Start Development Servers
```bash
# Laravel Backend
php artisan serve

# WebSocket Server
php artisan websockets:serve
```

## Configuration

### Environment Variables
Refer to `.env.example` for required configuration:
- Database connection details
- WebSocket settings
- Firebase credentials
- Notification channel preferences

## Testing

### Running Tests
```bash
php artisan test
```


