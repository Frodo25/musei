<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ExhibitController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\CatalogController;
// Публичные страницы
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/rules', [PageController::class, 'rules'])->name('rules');
Route::redirect('/main', '/');

Route::get('/hello/{name}', function (string $name) {
    return 'Здравствуйте, ' . $name . '! Добро пожаловать в Музей.';
});

// Каталог для пользователей
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/catalog/{id}', [CatalogController::class, 'show'])->whereNumber('id')->name('catalog.show');

Route::get('/exhibits', [CatalogController::class, 'index'])->name('exhibits.index');
Route::get('/exhibits/{id}', [CatalogController::class, 'show'])->whereNumber('id')->name('exhibits.show');

// Скачивание файлов
Route::get('/exhibits/{exhibit}/download', function ($exhibit) {
    return Storage::download($exhibit->attachment);
})->middleware('auth');

// Авторизация и регистрация
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1');
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// Админ-панель (единый правильный блок)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin-panel'])->group(function () {
    Route::view('/', 'admin.dashboard')->name('dashboard');
    
    // Ресурсы админки
    Route::resource('exhibits', ExhibitController::class)->except('show');
    Route::resource('halls', HallController::class)->except('show');
    
    // Старая музейная страница
    Route::get('/museum', function () {
        $items = [
            1 => ['title' => 'Золотой человек', 'author' => 'Саглы', 'year' => 1970],
            2 => ['title' => 'Сарматский вождь', 'author' => 'Археологическая находка', 'year' => 2005],
            3 => ['title' => 'Каменные изваяния', 'author' => 'Древние мастера', 'year' => 800],
            4 => ['title' => 'Кокандский фарфор', 'author' => 'Мастера Востока', 'year' => 1850],
            5 => ['title' => 'Старинный казахский ковер', 'author' => 'Народное творчество', 'year' => 1910],
        ];
        return view('admin.museum.index', ['items' => $items]);
    })->name('museum');

    Route::view('/museum/create', 'admin.museum.create')->name('museum.create');
});

Route::get('/admin/logout', function () {
    session()->forget('is_admin');
    return redirect('/');
})->name('admin.logout');