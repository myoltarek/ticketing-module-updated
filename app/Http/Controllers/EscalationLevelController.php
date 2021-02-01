<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        // dd($request->all());

        $input = Input::all();

        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Level name is required',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $escalation_level = new EscalationLevel;
        $escalation_level->name = $request['name'];
        $escalation_level->days = $request['days'];
        $escalation_level->save();

        Alert::success('Success', 'Successfully Cretared');

        return redirect('escalation-levels');

    }

    public function edit($id)
    {
        $escalation_level = EscalationLevel::findOrFail($id);

        return view('escalation_levels.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        $escalation_level = EscalationLevel::findOrFail($id);

        $input = Input::all();

        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name.required' => 'Level name is required',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $escalation_level->name = $request['name'];
        $escalation_level->days = $request['days'];
        $escalation_level->save();

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
}
