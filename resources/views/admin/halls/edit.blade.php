@extends('layouts.app')

@section('title', 'Редактирование зала')

@section('content')
    <h1>Редактировать зал</h1>
    
    <form method="POST" action="{{ route('admin.halls.update', $hall) }}">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 12px;">
            <label>Название зала:</label><br>
            <input type="text" name="name" value="{{ old('name', $hall->name) }}" style="{{ $errors->has('name') ? 'border: 2px solid red;' : '' }}">
            @error('name') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
        </div>
        <button type="submit">Сохранить</button>
    </form>

    <p style="margin-top: 15px;"><a href="{{ route('admin.halls.index') }}">Назад</a></p>
@endsection