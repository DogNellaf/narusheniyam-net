# Narusheniyam.Net

> 🇬🇧 English | [🇷🇺 Русский](README.ru.md)

A web application for reporting road traffic violations. Users can submit reports with a vehicle registration number and a description of the incident. Moderators review each submission and update its status.

## Features

- User registration and authentication
- Submit violation reports (vehicle number + description)
- Personal dashboard with report history and statuses
- Admin panel: review and update the status of any report
- Flash notifications for successful operations
- Paginated violation lists
- Responsive Bootstrap 5 interface

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.1+, Laravel 10 |
| Database | MySQL 8 |
| Frontend | Bootstrap 5, Font Awesome 5 |
| Build | Vite |
| Auth | Laravel built-in (session-based) |
| Testing | PHPUnit 10 |

## Requirements

- PHP >= 8.1
- Composer
- Node.js >= 18 & npm
- MySQL >= 8.0

## Installation

```bash
# Clone the repository
git clone <repository-url>
cd No_violation

# Install PHP dependencies
composer install

# Install Node dependencies and build assets
npm install && npm run build

# Configure environment
cp .env.example .env
php artisan key:generate

# Set up the database (edit .env first — fill in DB_DATABASE, DB_USERNAME, DB_PASSWORD)
php artisan migrate

# Run the development server
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Environment Variables

Key variables in `.env`:

| Variable | Description |
|---|---|
| `APP_URL` | Public URL of the application |
| `DB_DATABASE` | Database name |
| `DB_USERNAME` | Database username |
| `DB_PASSWORD` | Database password |
| `MAIL_*` | Mail settings (for password reset) |

## Creating an Admin User

After running migrations, promote any user to admin directly in the database:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'admin@example.com';
```

Or via Artisan Tinker:

```bash
php artisan tinker
>>> \App\Models\User::where('email', 'admin@example.com')->update(['is_admin' => true]);
```

## Violation Statuses

| Status | Meaning |
|---|---|
| Новое | Newly submitted, awaiting review |
| Подтверждено | Confirmed by a moderator |
| Отклонено | Rejected by a moderator |

## Running Tests

Configure a test database in `phpunit.xml`, or use in-memory SQLite, then run:

```bash
php artisan test
```

To run a specific suite:

```bash
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature
```

## Project Structure

```
app/
  Http/
    Controllers/          # MainController, HomeController, ViolationsController
    Middleware/           # Authenticate, CheckIfAdmin
  Models/                 # User, Violation
database/
  factories/              # UserFactory, ViolationFactory
  migrations/
resources/
  views/
    layouts/              # app.blade.php (main layout)
    auth/                 # login, register
    dashboard/            # index, user-info
    violations/           # create, edit, detail
routes/
  web.php
tests/
  Feature/                # AuthTest, DashboardTest, ViolationTest
  Unit/                   # UserTest, ViolationTest
```

## License

[MIT](LICENSE)
