@extends('layouts.app')
@section('title', 'Мои заявления')
@section('content')
	<a class="btn btn-info violation-create text-end" href="{{ route('violation.create') }}">Добавить заявление</a>
	@if (count($violations) > 0 && Auth::user())
	<table class="table table-striped table-borderless">
		<thead>
			<tr>
				<th>Описание</th>
				<th>Номер</th>
				<th>Статус</th>
				<th colspan="2">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($violations as $violation)
			<tr>
				<td><h3>{{ $violation->description }}</h3></td>
				<td>{{ $violation->number }}</td>
				<td>{{ $violation->status }}</td>
				@if ( Auth::user()->is_admin)
					<td>
						<a href="{{ route('violation.edit', ['violation' => $violation]) }}">Изменить</a>
					</td>
				@endif
			</tr>
			@endforeach
		</tbody>
	</table>
	@else
		<p class="text-center">
			Заявлений нет
		</p>
	@endif
@endsection('content')