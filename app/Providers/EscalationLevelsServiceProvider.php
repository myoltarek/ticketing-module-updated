<?php

namespace App\Providers;

use App\Http\View\Composers\EscalationLevelComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class EscalationLevelsServiceProvider extends ServiceProvider
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
        View::composer(['escalation_matrix.create','escalation_matrix.edit'], EscalationLevelComposer::class);
    }
}
