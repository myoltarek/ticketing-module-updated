<?php


namespace App\Http\View\Composers;


use App\Models\Division;
use Illuminate\View\View;

class DivisionsComposer
{
    public function compose(View $view)
    {
        $view->with('divisions', Division::all()->pluck('name', 'id'));
    }
}
