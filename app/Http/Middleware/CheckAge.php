<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    public function handle(Request $request, Closure $next): Response
    {
        // Пример проверки: если параметр age меньше 18
        if ($request->input('age') < 18) {
            abort(403, 'Доступ запрещен: вам нет 18 лет.');
        }

        return $next($request); // Пропустить запрос дальше к маршруту
    }
}