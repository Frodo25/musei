<?php

namespace App\Observers;

use App\Models\Hall;
use Illuminate\Support\Facades\Cache;

class HallObserver
{
    public function saved(Hall $hall): void
    {
        Cache::forget('home.museum.stats');
    }

    public function deleted(Hall $hall): void
    {
        Cache::forget('home.museum.stats');
    }
}