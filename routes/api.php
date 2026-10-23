<?php
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ExhibitController;
use App\Http\Controllers\Api\V1\HallController;
use App\Http\Resources\ExhibitResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->middleware('throttle:60,1')->group(function () {
    
    Route::get('/ping', fn () => response()->json([
        'status' => 'ok', 
        'time' => now()->toIso8601String()
    ], 200, [], JSON_UNESCAPED_UNICODE));

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');
    Route::get('/exhibits/random', function () {
        $exhibit = \App\Models\Exhibit::with('hall')->inRandomOrder()->first();
        if (!$exhibit) {
            return response()->json(['message' => 'Экспонатов нет'], 404);
        }
        return new ExhibitResource($exhibit);
    })->name('exhibits.random');

    Route::get('/stats', function () {
        $stats = Cache::remember('api.stats', now()->addMinutes(5), function () {
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
    Route::apiResource('exhibits', ExhibitController::class)->only(['index', 'show']);
    Route::get('/halls', [HallController::class, 'index'])->name('halls.index');
    Route::get('/halls/{hall}/exhibits', [HallController::class, 'exhibits'])->name('halls.exhibits');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('me');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::apiResource('exhibits', ExhibitController::class)->only(['store', 'update', 'destroy']);
    });
});