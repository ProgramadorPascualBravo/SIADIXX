<?php

namespace App\Providers;

use App\Enrollment;
use App\Observers\EnrollmentsObserver;
use Illuminate\Support\ServiceProvider;

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
        Enrollment::observe(EnrollmentsObserver::class);
    }
}
