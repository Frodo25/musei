@extends('layouts.app')

@section('title', 'Вход в систему')

@section('content')
    <h1>Вход</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div style="margin-bottom: 12px;">
            <label>E-mail:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <div style="margin-bottom: 12px;">
            <label>Пароль:</label><br>
            <input type="password" name="password">
        </div>
        <div style="margin-bottom: 12px;">
            <label><input type="checkbox" name="remember"> Запомнить меня</label>
        </div>
        <button type="submit" class="btn">Войти</button>
    </form>
@endsection