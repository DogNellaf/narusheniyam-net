# Нарушениям.Нет — Портал сообщений о нарушениях ПДД

> [🇬🇧 English](README.md) | 🇷🇺 Русский

Веб-приложение для подачи жалоб на нарушения правил дорожного движения. Пользователи могут отправить заявление, указав номер автомобиля и описание произошедшего. Модераторы рассматривают каждое обращение и обновляют его статус.

## Возможности

- Регистрация и аутентификация пользователей
- Подача заявлений о нарушениях (номер автомобиля + описание)
- Личный кабинет с историей заявлений и их статусами
- Панель администратора: просмотр и изменение статуса любого заявления
- Flash-уведомления об успешных операциях
- Постраничный вывод списка заявлений
- Адаптивный интерфейс на Bootstrap 5

## Технологии

| Слой | Технология |
|---|---|
| Backend | PHP 8.1+, Laravel 10 |
| База данных | MySQL 8 |
| Frontend | Bootstrap 5, Font Awesome 5 |
| Сборка | Vite |
| Аутентификация | Встроенная Laravel (сессии) |
| Тестирование | PHPUnit 10 |

## Требования

- PHP >= 8.1
- Composer
- Node.js >= 18 и npm
- MySQL >= 8.0

## Установка

```bash
# Клонировать репозиторий
git clone <url-репозитория>
cd No_violation

# Установить PHP-зависимости
composer install

# Установить Node-зависимости и собрать ассеты
npm install && npm run build

# Настроить окружение
cp .env.example .env
php artisan key:generate

# Настроить базу данных (отредактируйте .env — заполните DB_DATABASE, DB_USERNAME, DB_PASSWORD)
php artisan migrate

# Запустить сервер разработки
php artisan serve
```

Приложение будет доступно по адресу `http://localhost:8000`.

## Переменные окружения

Основные переменные в `.env`:

| Переменная | Описание |
|---|---|
| `APP_URL` | Публичный URL приложения |
| `DB_DATABASE` | Имя базы данных |
| `DB_USERNAME` | Пользователь базы данных |
| `DB_PASSWORD` | Пароль базы данных |
| `MAIL_*` | Настройки почты (для сброса пароля) |

## Создание администратора

После выполнения миграций назначьте права администратора любому пользователю напрямую в базе данных:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'admin@example.com';
```

Или через Artisan Tinker:

```bash
php artisan tinker
>>> \App\Models\User::where('email', 'admin@example.com')->update(['is_admin' => true]);
```

## Статусы заявлений

| Статус | Значение |
|---|---|
| Новое | Только что подано, ожидает рассмотрения |
| Подтверждено | Подтверждено модератором |
| Отклонено | Отклонено модератором |

## Запуск тестов

Настройте тестовую базу данных в `phpunit.xml` или используйте SQLite в памяти, затем выполните:

```bash
php artisan test
```

Запуск конкретного набора:

```bash
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature
```

## Структура проекта

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
    layouts/              # app.blade.php (основной шаблон)
    auth/                 # login, register
    dashboard/            # index, user-info
    violations/           # create, edit, detail
routes/
  web.php
tests/
  Feature/                # AuthTest, DashboardTest, ViolationTest
  Unit/                   # UserTest, ViolationTest
```

## Лицензия

[MIT](LICENSE)
