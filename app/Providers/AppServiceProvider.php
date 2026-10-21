<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Contracts\SmsSender;
use App\Services\Sms\LogSmsSender;
use App\Services\Sms\NullSmsSender;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->singleton(SmsSender::class, function () {
        return match (config('services.sms.driver')) {
            'log'   => new LogSmsSender(),
            default => new NullSmsSender(),
        };
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    Gate::define('admin-panel', function (User $user) {
        return in_array($user->role, ['admin', 'editor']);
    });
    }
}
