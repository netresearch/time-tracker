<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AuditLog;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AuditLog::observe(AuditLogObserver::class);
    }
}
