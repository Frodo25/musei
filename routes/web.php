
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExhibitController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/hello/{name}', function ($name) {
    return 'Здравствуйте, ' . $name . '!';
});

Route::get('/exhibits/{id}', [ExhibitController::class, 'show']);
