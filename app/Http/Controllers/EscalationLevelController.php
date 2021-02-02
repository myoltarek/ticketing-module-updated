<?php

namespace App\Http\Controllers;

use App\Http\Requests\EscalationLevelFormValidation;
use App\Models\EscalationLevel;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Alert;

class EscalationLevelController extends Controller
{
    public function index()
    {
        $escalation_levels = EscalationLevel::get();

        return view('escalation_levels.index', get_defined_vars());
    }

    public function create()
    {
        return view('escalation_levels.create');
    }

    public function store(EscalationLevelFormValidation $request)
    {
        $escalation_level = new EscalationLevel;
        $this->dataStore($escalation_level,$request);

        Alert::success('Success', 'Successfully Cretared');

        return redirect('escalation-levels');

    }

    public function edit($id)
    {
        $escalation_level = EscalationLevel::findOrFail($id);

        return view('escalation_levels.edit', get_defined_vars());
    }

    public function update(EscalationLevelFormValidation $request, $id)
    {
        $escalation_level = EscalationLevel::findOrFail($id);
        $this->dataStore($escalation_level,$request);

        Alert::success('Success', 'Successfully Updated');

        return redirect('escalation-levels');
    }

    public function destroy($id)
    {
        try {
            EscalationLevel::findOrFail($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }

    protected function dataStore($escalation_level,$request)
    {
        $escalation_level->name = $request['name'];
        $escalation_level->days = $request['days'];
        $escalation_level->save();
    }
}
