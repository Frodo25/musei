@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация пользователя</h1>

    <form method="POST" action="{{ route('register') }}" style="max-width: 400px; margin-top: 20px;">
        @csrf

        {{-- Имя --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Имя:</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   style="width: 100%; padding: 8px; box-sizing: border-box; {{ $errors->has('name') ? 'border: 2px solid red;' : '' }}">
            @error('name')
                <div style="color: red; font-size: 0.9em; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- E-mail --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">E-mail:</label>
            <input type="email" name="email" value="{{ old('email') }}" 
                   style="width: 100%; padding: 8px; box-sizing: border-box; {{ $errors->has('email') ? 'border: 2px solid red;' : '' }}">
            @error('email')
                <div style="color: red; font-size: 0.9em; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Пароль --}}
        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Пароль:</label>
            <input type="password" name="password" 
                   style="width: 100%; padding: 8px; box-sizing: border-box; {{ $errors->has('password') ? 'border: 2px solid red;' : '' }}">
            @error('password')
                <div style="color: red; font-size: 0.9em; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Подтверждение пароля --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 5px;">Подтверждение пароля:</label>
            <input type="password" name="password_confirmation" 
                   style="width: 100%; padding: 8px; box-sizing: border-box;">
        </div>

        <button type="submit" class="btn">Зарегистрироваться</button>
    </form>

    <div style="margin-top: 15px;">
        Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
    </div>
@endsection