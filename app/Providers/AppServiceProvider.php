<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('teacher', function(){
            return auth()->user()->role_id == 2; 
        });

        Blade::if('student', function(){
            return auth()->user()->role_id == 3; 
        });
    }
}
