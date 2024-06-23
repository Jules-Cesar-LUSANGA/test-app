<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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

        // Verify if given question is qcm
        Blade::if('qcm', function($question){
            return $question->qcm == true;
        });


        Model::preventLazyLoading(!$this->app->isProduction());
    }
}
