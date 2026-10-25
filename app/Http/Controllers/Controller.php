<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Museum API Documentation",
 *      description="Документация REST API для музейного проекта (ЛР №16)"
 * )
 * @OA\Server(
 *      url="http://127.0.0.1:8000",
 *      description="Локальный сервер"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}