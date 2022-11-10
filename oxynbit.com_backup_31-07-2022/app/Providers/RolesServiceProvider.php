<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('roles', function ($roles){
            return "<?php if(auth()->check() && auth()->user()->hasRoles(explode(',', $roles))): ?>";
        });

        Blade::directive('endroles', function ($role){
            return "<?php endif; ?>";
        });
    }
}
