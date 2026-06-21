@extends('layouts.app')
@section('title', 'Добавить заявление')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Новое заявление</div>
            <div class="card-body">
                <form action="{{ route('violation.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание нарушения</label>
                        <textarea name="description" id="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Номер автомобиля</label>
                        <input type="text" name="number" id="number"
                            class="form-control @error('number') is-invalid @enderror"
                            value="{{ old('number') }}" placeholder="А123БВ77">
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
