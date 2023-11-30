<?php

namespace App\Providers;

use App\Models\Pending;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
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
        Artisan::call("route:clear");
        Artisan::call("view:clear");
        Artisan::call("config:clear");
        Artisan::call("cache:clear");
        Artisan::call("optimize:clear");
        file_put_contents(storage_path('logs/laravel.log'), '');
        Paginator::useBootstrap();
        view()->share('countPending', Pending::count());
    }
}
