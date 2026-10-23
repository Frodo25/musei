<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ExhibitController;
use App\Http\Controllers\Api\V1\HallController;
Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {
    Route::get('/ping', fn () => response()->json([
        'status' => 'ok', 
        'time' => now()->toIso8601String()
    ], 200, [], JSON_UNESCAPED_UNICODE));

    Route::apiResource('exhibits', ExhibitController::class)->only(['index', 'show']);
    Route::get('/halls', [HallController::class, 'index'])->name('halls.index');
    Route::get('/halls/{hall}/exhibits', [HallController::class, 'exhibits'])->name('halls.exhibits');
    Route::get('/ping', fn () => ['status' => 'ok', 'time' => now()->toIso8601String()]);

    Route::apiResource('exhibits', ExhibitController::class)->only(['index', 'show']);

    Route::get('/halls', [HallController::class, 'index'])->name('halls.index');
    Route::get('/halls/{hall}/exhibits', [HallController::class, 'exhibits'])->name('halls.exhibits');
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/stats', function () {
    $stats = \Illuminate\Support\Facades\Cache::remember('api.stats', now()->addMinutes(5), function () {
        return [
            'total_exhibits' => \App\Models\Exhibit::count(),
            'halls_breakdown' => \App\Models\Hall::withCount('exhibits')->get()->map(fn($h) => [
                'hall' => $h->name,
                'count' => $h->exhibits_count,
            ]),
            'last_added' => \App\Models\Exhibit::latest()->value('created_at')?->toIso8601String(),
        ];
    });
    return response()->json($stats, 200, [], JSON_UNESCAPED_UNICODE);
})->name('stats');

Route::get('/exhibits/random', function () {
    $exhibit = \App\Models\Exhibit::with('hall')->inRandomOrder()->first();
    if (!$exhibit) {
        return response()->json(['message' => 'Экспонатов нет'], 404);
    }
    return new ExhibitResource($exhibit);
})->name('exhibits.random');
