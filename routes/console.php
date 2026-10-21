<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Exhibit;
use App\Models\Hall;
use App\Models\User;
use Illuminate\Support\Facades\Schedule;
Artisan::command('catalog:stats', function () {
    $this->info('=== Статистика Музея ===');

    $halls = Hall::withCount('exhibits')->get();
    $rows = $halls->map(fn($hall) => [$hall->name, $hall->exhibits_count])->toArray();

    $this->line('Экспонаты по залам:');
    $this->table(['Зал', 'Кол-во экспонатов'], $rows);

    $usersCount = User::select('role', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
        ->groupBy('role')
        ->get()
        ->map(fn($u) => [$u->role, $u->total])
        ->toArray();

    $this->line('Пользователи по ролям:');
    $this->table(['Роль', 'Кол-во'], $usersCount);
})->purpose('Выводит статистику музея');
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('exhibits:archive-old --days=30')
    ->dailyAt('02:00')
    ->withoutOverlapping();

Schedule::command('catalog:stats')
    ->everyMinute()
    ->appendOutputTo(storage_path('logs/stats.log'));
