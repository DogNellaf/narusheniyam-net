@extends('layouts.app')
@section('title', 'Редактор персональных данных')
@section('content')
<div class="row justify-content-center mt-3 mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Персональные данные</div>

            <div class="card-body">
                <form method="POST" action="{{ route('user.info.save') }}">
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Логин</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-end">Номер телефона</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="phone_number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $user->phone_number }}" required autocomplete="phone_number">

                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="lastname" class="col-md-4 col-form-label text-md-end">Фамилия</label>

                        <div class="col-md-6">
                            <input id="lastname" type="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname">

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end">Имя</label>

                        <div class="col-md-6">
                            <input id="firstname" type="firstname" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname">

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="middlename" class="col-md-4 col-form-label text-md-end">Отчество</label>

                        <div class="col-md-6">
                            <input id="middlename" type="middlename" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ $user->middlename }}" required autocomplete="middlename">

                            @error('middlename')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')