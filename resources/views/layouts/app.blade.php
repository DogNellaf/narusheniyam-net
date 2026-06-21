<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>@yield('title') — Нарушениям.Нет</title>
    <meta name="description" content="Портал для подачи жалоб на нарушения ПДД. Укажите номер автомобиля и опишите ситуацию — заявление будет рассмотрено в кратчайшие сроки." />
    <meta name="keywords" content="ПДД,нарушения,жалоба,ГИБДД,парковка,авария" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="nofollow" />
    <style>
        .content { margin-top: 10vh; }
        .footer { position: relative; bottom: 0; width: 100%; text-align: center; padding: 20px 0; margin-top: 40px; }
        .index img { width: 60vw; margin-left: 15vw; }
        .dashboard .violation p { line-height: 37px; }
    </style>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body class="container-fluid">
    <div class="row header">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a href="{{ route('index') }}" class="navbar-brand me-auto">Нарушениям.Нет</a>
                @guest
                    <a href="{{ route('register') }}" class="nav-item nav-link">Регистрация</a>
                    <a href="{{ route('login') }}" class="nav-item nav-link">Вход</a>
                @endguest
                @auth
                    <a href="{{ route('home') }}" class="nav-item nav-link">Мои заявления</a>
                    <form action="{{ route('logout') }}" method="POST" class="form-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger ms-2">Выход</button>
                    </form>
                @endauth
            </div>
        </nav>
    </div>

    <div class="container content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="footer">
        <div class="row">
            <div class="col">
                <a href="{{ route('index') }}">Главная</a>
                &nbsp;|&nbsp;
                <a href="{{ route('register') }}">Регистрация</a>
                &nbsp;|&nbsp;
                <a href="{{ route('login') }}">Вход</a>
                @auth
                    &nbsp;|&nbsp;
                    <a href="{{ route('home') }}">Мои заявления</a>
                @endauth
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
