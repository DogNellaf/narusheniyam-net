@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
<div class="row dashboard">
    <div class="col">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Личный кабинет</h1>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-secondary" href="{{ route('user.info') }}">Изменить данные</a>
                <a class="btn btn-primary" href="{{ route('violation.create') }}">Добавить заявление</a>
            </div>
        </div>

        @if ($violations->isEmpty())
            <p class="text-center text-muted mt-4">Заявлений нет.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Номер машины</th>
                            <th>Описание</th>
                            <th>Статус</th>
                            <th>Дата</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($violations as $violation)
                            <tr>
                                <td>{{ $violation->id }}</td>
                                <td>{{ $violation->number }}</td>
                                <td>{{ Str::limit($violation->description, 60) }}</td>
                                <td>
                                    @if ($violation->status === \App\Models\Violation::STATUS_CONFIRMED)
                                        <span class="badge bg-success">{{ $violation->status }}</span>
                                    @elseif ($violation->status === \App\Models\Violation::STATUS_REJECTED)
                                        <span class="badge bg-danger">{{ $violation->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $violation->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $violation->created_at->format('d.m.Y') }}</td>
                                <td>
                                    @if (Auth::user()->isAdmin())
                                        <a class="btn btn-sm btn-info text-light"
                                           href="{{ route('violation.edit', $violation) }}">Редактировать</a>
                                    @else
                                        <a class="btn btn-sm btn-info text-light"
                                           href="{{ route('violation.detail', $violation) }}">Подробнее</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $violations->links() }}
        @endif
    </div>
</div>
@endsection
