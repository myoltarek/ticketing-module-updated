<?php

namespace App\Providers;

use App\Http\View\Composers\DivisionsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DivisionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['districts.create','districts.edit'], DivisionsComposer::class);
    }
}
