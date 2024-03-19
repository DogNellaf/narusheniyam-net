@extends('layouts.app')
@section('title', 'Нарушений.Нет')
@section('content')
    <div class="row index">
        <div class="col">
            <p>Сервис "Нарушениям Нет" предназначен для фиксации нарушений ПДД среди участников дорожного движения.</p>
            <p>Вы можете сообщить о нарушении, указав номер машины и описание произошедшего.</p>
            <img width="900" height="600" alt="Пример нарушения" src="{{ asset('images/index.webp') }}"/>
        </div>
    </div>
@endsection('content')