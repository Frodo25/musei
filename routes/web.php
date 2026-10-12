<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'name' => 'Иванов Иван', // Укажите ваши ФИО
        'group' => 'ИС-21'     // Укажите вашу группу
    ]);
})->name('about');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/hello/{name}', function (string $name) {
    return 'Здравствуйте, ' . $name . '! Добро пожаловать в Музей.';
});

Route::get('/exhibits/{id}', function (string $id) {
    return view('exhibit', ['id' => $id]);
})->whereNumber('id')->name('exhibits.show');