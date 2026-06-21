@extends('layouts.app')
@section('title', 'Заявление №' . $violation->id)
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                Заявление №{{ $violation->id }}
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Номер автомобиля</dt>
                    <dd class="col-sm-8">{{ $violation->number }}</dd>

                    <dt class="col-sm-4">Описание</dt>
                    <dd class="col-sm-8">{{ $violation->description }}</dd>

                    <dt class="col-sm-4">Статус</dt>
                    <dd class="col-sm-8">
                        @if ($violation->status === \App\Models\Violation::STATUS_CONFIRMED)
                            <span class="badge bg-success">{{ $violation->status }}</span>
                        @elseif ($violation->status === \App\Models\Violation::STATUS_REJECTED)
                            <span class="badge bg-danger">{{ $violation->status }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $violation->status }}</span>
                        @endif
                    </dd>

                    <dt class="col-sm-4">Дата подачи</dt>
                    <dd class="col-sm-8">{{ $violation->created_at->format('d.m.Y H:i') }}</dd>
                </dl>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('home') }}" class="btn btn-secondary">Назад</a>
            </div>
        </div>
    </div>
</div>
@endsection
