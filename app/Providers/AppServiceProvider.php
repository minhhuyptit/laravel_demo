<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Slide;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $slide = Slide::all();
        // view()->share('slide', $slide);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
