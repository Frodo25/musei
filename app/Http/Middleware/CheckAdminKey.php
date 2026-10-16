<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $configKey = config('app.admin_key');

        // Если ADMIN_KEY в .env пустой — доступ закрыт всегда (защита от null === null)
        if (empty($configKey)) {
            abort(403, 'Ключ администратора не настроен или закрыт.');
        }

        // Если в запросе передан верный параметр ?key=...
        if ($request->query('key') === $configKey) {
            $request->session()->put('is_admin', true);
        }

        // Если в сессии нет флага администратора — возвращаем 403 ошибку
        if (! $request->session()->get('is_admin')) {
            abort(403, 'Нужен ключ администратора');
        }

        return $next($request);
    }
}