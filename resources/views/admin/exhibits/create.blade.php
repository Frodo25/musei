@extends('layouts.app')

@section('title', 'Добавление экспоната')

@section('content')
    <h1>Добавить экспонат</h1>
    @include('admin.exhibits._form', ['action' => route('admin.exhibits.store')])
@endsection
<div style="margin-bottom: 12px;">
    <label>Обложка (изображение):</label><br>
    <input type="file" name="cover" accept="image/*">
    @error('cover') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
</div>