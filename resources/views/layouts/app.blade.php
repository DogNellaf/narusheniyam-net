<html>
	<head>
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<title>@yield('title')</title>
	</head>
	<body>
		<header>
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
						<input type="submit" class="btn btn-danger" style="margin-top: 20px" value="Выход"/>
					</form>
					@endauth
				</div>
			</nav>
		</header>
		<div class="container">
			@yield('content')
		</div>
		<footer>
			<p></p>
		</footer>
	</body>
</html>