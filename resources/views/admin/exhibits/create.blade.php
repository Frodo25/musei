@extends('layouts.app')

@section('title', 'Добавление экспоната')

@section('content')
    <h1>Добавить экспонат</h1>
    @include('admin.exhibits._form', ['action' => route('admin.exhibits.store')])
@endsection