@extends('layouts.app')
@section('title', 'Добавить заявление')
@section('content')
<form action="{{ route('violation.store') }}" method="POST">
	@csrf
	<div class="mb-3">
		<label for="description" class="form-label">Описание</label>
		<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" row="3"></textarea>
		@error('description')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
	<div class="mb-3">
		<label for="number" class="form-label">Номер автомобиля</label>
		<input name="number" id="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}">
		@error('number')
			<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
	<input type="submit" class="btn btn-primary" value="Добавить">
</form>
@endsection('content')