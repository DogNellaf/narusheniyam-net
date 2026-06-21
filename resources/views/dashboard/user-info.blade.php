@extends('layouts.app')
@section('title', 'Персональные данные')
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
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-end">Телефон</label>
                        <div class="col-md-6">
                            <input id="phone_number" type="tel"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                                placeholder="+79001234567" required>
                            @error('phone_number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="lastname" class="col-md-4 col-form-label text-md-end">Фамилия</label>
                        <div class="col-md-6">
                            <input id="lastname" type="text"
                                class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                            @error('lastname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end">Имя</label>
                        <div class="col-md-6">
                            <input id="firstname" type="text"
                                class="form-control @error('firstname') is-invalid @enderror"
                                name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                            @error('firstname')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="middlename" class="col-md-4 col-form-label text-md-end">Отчество</label>
                        <div class="col-md-6">
                            <input id="middlename" type="text"
                                class="form-control @error('middlename') is-invalid @enderror"
                                name="middlename" value="{{ old('middlename', $user->middlename) }}">
                            @error('middlename')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Новый пароль</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" autocomplete="new-password">
                            <div class="form-text">Оставьте пустым, если не хотите менять пароль.</div>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Подтверждение пароля</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password"
                                class="form-control"
                                name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary ms-2">Назад</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
