<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   //NGROK HTTPS, UNCOMMENT BAWAH, 
        // 1. php artisan serve (auto port 8000)
        // 2. ngrok http 8000 (8000 itu port dari serve laravel)


        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
