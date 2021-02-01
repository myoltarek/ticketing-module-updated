<?php

namespace App\Providers;

use App\Http\View\Composers\UsersComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
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
        View::composer(['assign_tickets.create','assign_tickets.edit','escalation_matrix.create','escalation_matrix.edit'], UsersComposer::class);
    }
}
