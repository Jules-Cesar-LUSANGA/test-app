<?php

namespace App\Providers;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    const ADMIN_ROLE_ID = 1;
    const TEACHER_ROLE_ID = 2;
    const STUDENT_ROLE_ID = 3;
    const SUPERVISOR_ROLE_ID = 4;
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
        Blade::if('admin', function(){
            return auth()->user()->role_id == self::ADMIN_ROLE_ID; 
        });

        Blade::if('teacher', function(){
            return auth()->user()->role_id == self::TEACHER_ROLE_ID; 
        });

        Blade::if('student', function(){
            return auth()->user()->role_id == self::STUDENT_ROLE_ID; 
        });

        Blade::if('supervisor', function(){
            return auth()->user()->role_id == self::SUPERVISOR_ROLE_ID; 
        });

        // Verify if given question is qcm
        Blade::if('qcm', function($question){
            return $question->qcm == true;
        });

        // Verify if given question is qcm
        Blade::if('notPresented', function(Exam $exam){
            if ($exam->presentations()->count() == 0) {
                return true;
            }
            return false;
        });


        Model::preventLazyLoading(!$this->app->isProduction());
    }
}
