# Narusheniyam.Net — Traffic Violation Reporting Portal

> [Русская версия](README.ru.md)

A web application for reporting road traffic violations. Users can submit reports with a vehicle registration number and a description of the incident. Moderators review each submission and update its status.

---

## Features

- User registration and authentication
- Submit violation reports (vehicle number + description)
- Personal dashboard with report history and statuses
- Admin panel: review and update the status of any report
- Flash notifications for successful operations
- Paginated violation lists
- Responsive Bootstrap 5 interface

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.1+, Laravel 10 |
| Database | MySQL 8 |
| Frontend | Bootstrap 5, Font Awesome 5 |
| Build | Vite |
| Auth | Laravel built-in (session-based) |
| Testing | PHPUnit 10 |

---

## Requirements

- PHP >= 8.1
- Composer
- Node.js >= 18 & npm
- MySQL >= 8.0

---

## Installation

```bash
# 1. Clone the repository
git clone <repository-url>
cd No_violation

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies and build assets
npm install && npm run build

# 4. Configure environment
cp .env.example .env
php artisan key:generate

# 5. Set up the database
# Edit .env — fill in DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan migrate

# 6. Start the development server
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

---

## Configuration

Key variables in `.env`:

| Variable | Description |
|---|---|
| `APP_URL` | Public URL of the application |
| `DB_DATABASE` | Database name |
| `DB_USERNAME` | Database username |
| `DB_PASSWORD` | Database password |
| `MAIL_*` | Mail settings (for password reset) |

---

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

---

## Violation Statuses

| Status | Meaning |
|---|---|
| Новое | Newly submitted, awaiting review |
| Подтверждено | Confirmed by a moderator |
| Отклонено | Rejected by a moderator |

---

## Running Tests

```bash
# Configure a test database in phpunit.xml or use :memory: SQLite
php artisan test
```

To run a specific suite:

```bash
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature
```

---

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

---

## License

This project is licensed under the MIT License.

```
MIT License

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
