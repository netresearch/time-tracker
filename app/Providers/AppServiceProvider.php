<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AuditLog;
use App\Http\Controllers\LoginController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginController::class, function ($app) {
            return new LoginController();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //AuditLog::observe(AuditLogObserver::class);
    }
}
