<?php

namespace Firmino\UserAcl\Providers;

use Firmino\UserAcl\Acl;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserAclServiceProvider extends ServiceProvider{

    public function boot () {
        Route::namespace('Firmino\UserAcl\Http\Controllers')
            ->middleware(['web']);

        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->publishes([
            __DIR__ . '/../Config/acl.php' => config_path('acl.php')
        ], 'config');

        $this->registerBlade();

    }

    public function register () {
        $this->app->singleton('UserAcl.acl', function ($app) {
            return new Acl();
        });
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/acl.php',
            'config'
        );
    }

    public function registerBlade () {
        Blade::directive('role', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->hasRole({$expression})): ?>";
        });
        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
