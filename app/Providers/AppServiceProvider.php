<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        Paginator::useBootstrap();

        //
        // detect  N+ 1 lazy loading SQL
        Model::preventLazyLoading(!app()->isProduction());

        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https://');
        }
    }
}
