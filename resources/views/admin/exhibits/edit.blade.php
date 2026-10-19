@extends('layouts.app')

@section('title', 'Редактирование экспоната')

@section('content')
    <h1>Редактировать экспонат</h1>
    @include('admin.exhibits._form', ['action' => route('admin.exhibits.update', $exhibit)])
@endsection