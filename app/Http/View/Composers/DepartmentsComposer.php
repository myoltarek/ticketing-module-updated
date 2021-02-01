<?php

namespace App\Http\View\Composers;

use App\Models\Department;
use Illuminate\View\View;

class DepartmentsComposer
{
    public function compose(View $view)
    {
        $view->with('departments', Department::all()->pluck('name', 'id'));
    }
}
