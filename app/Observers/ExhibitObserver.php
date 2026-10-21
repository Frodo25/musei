<?php

namespace App\Observers;

use App\Models\Exhibit;
use Illuminate\Support\Facades\Cache;

class ExhibitObserver
{
    public function saved(Exhibit $exhibit): void
    {
        Cache::forget('home.museum.stats');
    }

    public function deleted(Exhibit $exhibit): void
    {
        Cache::forget('home.museum.stats');
    }
}