<?php


namespace App\Http\View\Composers;


use App\Models\EscalationLevel;
use Illuminate\View\View;

class EscalationLevelComposer
{
    public function compose(View $view)
    {
        $view->with('escalation_levels', EscalationLevel::all()->pluck('name', 'id'));
    }
}
