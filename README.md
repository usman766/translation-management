# Translation Management Service

This project is a Laravel-based API-driven Translation Management Service designed to store and manage translations across multiple locales, providing performance and scalability.

---

## Features

1. Store translations for multiple locales (e.g., `en`, `fr`, `es`) with scalability.
2. Tag translations for context (e.g., `mobile`, `desktop`, `web`).
3. CRUD API endpoints for managing translations.
4. JSON export endpoint for frontend integration.
5. Token-based authentication for secure access Use passport.
6. Docker setup for containerization.
7. Optimized for performance with a focus on response times.

---

## Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Docker

### Steps

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd translation-management-service
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the environment variables:
   ```bash
   cp .env.example .env
   ```

4. Update database configuration in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=translation_db
   DB_USERNAME=
   DB_PASSWORD=
   ```

5. Start Docker containers:
   ```bash
   docker-compose up -d
   ```

6. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```

7. Generate an application key:
   ```bash
   php artisan key:generate
   ```

8. Start the application:
   ```bash
   php artisan serve
   ```

---

## API Endpoints

| Method | Endpoint              | Description                                   |
|--------|-----------------------|-----------------------------------------------|
| POST   | `/api/translations`   | Create a new translation                     |
| GET    | `/api/translations`   | Get a list of translations with filters      |
| GET    | `/api/translations/{id}` | Get a specific translation                  |
| PUT    | `/api/translations/{id}` | Update an existing translation              |
| DELETE | `/api/translations/{id}` | Delete a translation                        |
| GET    | `/api/translations/export` | Export translations in JSON format         |

---

## Testing

Run unit and feature tests:
```bash
php artisan test
```

---

## Docker

This project includes a Docker setup for easy containerization.

### Build and Run
```bash
docker-compose up -d
```

For ease of testing, we provide a **Postman collection** with all endpoints, available [here](./Translation Management API.postman_collection.json).


### Docker Services
- **App**: Runs the Laravel application.
- **MySQL**: Database service.

---
