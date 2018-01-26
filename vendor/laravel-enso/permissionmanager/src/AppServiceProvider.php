<?php

namespace LaravelEnso\PermissionManager;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\PermissionManager\app\Http\Middleware\VerifyRouteAccess;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('verify-route-access', VerifyRouteAccess::class);

        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/resource-permissions.php', 'resource-permissions');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'permissions-assets');

        $this->publishes([
            __DIR__.'/resources/assets/js' => resource_path('assets/js'),
        ], 'enso-assets');
    }

    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
    }
}
