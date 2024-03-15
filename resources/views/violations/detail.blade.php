@extends('layouts.app')
@section('title', 'Информация о заявлении')
@section('content')
	<div class="row">
		<div class="col">
			<div class="card text-center">
				<div class="card-header">
					Информация о Заявлении №{{$violation->id}}
				</div>
				<div class="card-body">
					<p class="card-text">Номер автомобиля: {{$violation->number}}</p>
					<p class="card-text">Описание: {{$violation->description}}</p>
					<p class="card-text">Статус: {{$violation->status}}</p>
					<p class="card-text">Автор: {{ $violation->user->lastname }} {{ $violation->user->firstname }} {{ $violation->user->id }}</p>
				</div>
				<div class="card-footer text-muted">
					Создано {{$violation->created_at}}
				</div>
			</div>
		</div>
	</div>
@endsection('content')