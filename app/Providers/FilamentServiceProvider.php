<?php

namespace App\Providers;
use App\Providers\Manager;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
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
        Filament::registerViewPath(resource_path('views/filament'));
    }
}
