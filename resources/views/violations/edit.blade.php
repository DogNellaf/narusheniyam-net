@extends('layouts.app')
@section('title', 'Редактирование заявления')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Заявление №{{ $violation->id }}</div>
            <div class="card-body">
                <form action="{{ route('violation.update', $violation) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label">Описание нарушения</label>
                        <textarea name="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $violation->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Номер автомобиля</label>
                        <input type="text" name="number"
                            class="form-control @error('number') is-invalid @enderror"
                            value="{{ old('number', $violation->number) }}">
                        @error('number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Статус</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            @foreach (\App\Models\Violation::STATUSES as $status)
                                <option value="{{ $status }}" {{ old('status', $violation->status) === $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>

                <form action="{{ route('violation.destroy', $violation) }}" method="POST" class="mt-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Удалить заявление №{{ $violation->id }}?')">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
