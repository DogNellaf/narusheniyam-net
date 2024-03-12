@extends('layouts.app')

@section('title', 'Редактирование заявления :: Мои заявления')

@section('content')
<form action="{{ route('violation.update', ['violation' => $violation]) }}"  method="POST">
	@csrf
	@method('PATCH')
	<div class="mb-3">
		<label for="Description" class="form-label">Описание</label>
		<textarea name="description" id="txtFullDescription" class="form-control @error('description') is-invalid @enderror" row="3">{{ $violation->description }}</textarea>
		@error('description')
		<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
	<div class="mb-3">
		<label for="Number" class="form-label">Номер</label>
		<input name="number" id="Number" class="form-control @error('number') is-invalid @enderror" value="{{ $violation->number }}">
		@error('number')
		<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
	<div class="mb-3">
		<label for="Status" class="form-label">Статус</label>
		<select name="status" id="Status" class="form-control @error('status') is-invalid @enderror">
			<option {{ $violation->status == 'Новое' ? 'selected' : '' }}>Новое</option>
			<option {{ $violation->status == 'Подтверждено' ? 'selected' : '' }}>Подтверждено</option>
			<option {{ $violation->status == 'Отклонено' ? 'selected' : '' }}>Отклонено</option>
		</select>
		@error('status')
		<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
	<input type="submit" class="btn btn-primary" value="Сохранить">
</form>
@endsection('content')