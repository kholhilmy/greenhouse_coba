<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        View::composer('layouts.navbars.auth.nav', function ($view) {
            // Ambil data alert dari database
            $alerts = DB::table('alerts')->orderBy('created_at', 'desc')->take(5)->get();
            $view->with('alerts', $alerts);
        });
    }
}
