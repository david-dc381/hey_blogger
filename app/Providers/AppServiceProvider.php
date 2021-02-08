<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// esta línea es para usar bootstrap ya que laravel 8 usa tailwind
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // par agregar las paginas de bootstrap 
        Paginator::useBootstrap();
    }
}
