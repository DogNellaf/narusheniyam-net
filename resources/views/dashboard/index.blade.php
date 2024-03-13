@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
<div class="row dashboard">
	<div class="col">
		<div class="row buttons"> 
			<div class="col-5"></div>
			<div class="col-4">
				<a class="btn btn-info white-color" href="">Изменить персональные данные</a>
			</div>
			<div class="col-3">
				<a class="btn btn-info white-color" href="{{ route('violation.create') }}">Добавить заявление</a>
			</div>
		</div>
		@if (count($violations) > 0 && Auth::user())
		@foreach ($violations as $violation)
			
		@endforeach
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
	</div>
</div>

@endsection('content')