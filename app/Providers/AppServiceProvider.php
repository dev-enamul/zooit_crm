<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // if ($this->app->environment('local')) {
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //     $this->app->register(TelescopeServiceProvider::class);
        // }
    }

 
    public function boot(): void
    {
        Blade::directive('can', function ($permission) { 
            return "<?php if(auth()->check() && auth()->user()->hasPermission({$permission})) : ?>";
        });

        Blade::directive('endcan', function () {
            return "<?php endif; ?>";
        });
    }
}
