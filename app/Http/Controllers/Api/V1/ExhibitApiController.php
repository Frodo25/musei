<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use Illuminate\Http\Request;
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
class ExhibitApiController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/exhibits",
     *      operationId="getExhibitsList",
     *      tags={"Exhibits"},
     *      summary="Получить список всех экспонатов",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный ответ"
     *      )
     * )
     */
    public function index()
    {
        return response()->json(Exhibit::all());
    }
}