@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
<div class="row dashboard mt-3">
	<div class="col">
		@if (!Auth::user())
			<p>Вы не были авторизованы</p>
		@else
			<div class="row buttons"> 
				<div class="col-4">
					<a class="btn btn-info text-light" href="">Изменить персональные данные</a>
				</div>
				<div class="col-4"></div>
				<div class="col-4">
					<a class="btn btn-info text-light" href="{{ route('violation.create') }}">Добавить заявление</a>
				</div>
			</div>
			@if (count($violations) > 0)
				<div class="row mt-3"> 
					<div class="col-2">
						<p>
							<strong>Уникальный номер</strong>
						</p>
					</div>
					<div class="col-2">
						<p>
							<strong>Номер машины</strong>
						</p>
					</div>
					<div class="col-3">
						<p>
							<strong>Текст</strong>
						</p>
					</div>
					<div class="col-2">
						<p>
							<strong>Статус</strong>
						</p>
					</div>
					<div class="col-3">
						<p>
							<strong>Действие</strong>
						</p>
					</div>
				</div>
				@foreach ($violations as $violation)
					<div class="row mt-3"> 
						<div class="col-2">
							<p>{{$violation->id}}</p>
						</div>
						<div class="col-2">
							<p>{{$violation->number}}</p>
						</div>
						<div class="col-3">
							<p>{{$violation->description}}</p>
						</div>
						<div class="col-2">
							<p>{{$violation->status}}</p>
						</div>
						@if (Auth::user()->is_admin)
							<div class="col-3">
								<a class="btn btn-info text-light" href="{{ route('violation.edit', ['violation' -> $violation]) }}">Редактировать</a>
							</div>
						@else
							<div class="col-3">
								<a class="btn btn-info text-light" href="{{ route('violation.detail', ['violation' -> $violation]) }}">Подробнее</a>
							</div>						
						@endif
					</div>
				@endforeach
			@else
				<p class="text-center">
					Заявлений нет
				</p>
			@endif
		@endif
	</div>
</div>

@endsection('content')