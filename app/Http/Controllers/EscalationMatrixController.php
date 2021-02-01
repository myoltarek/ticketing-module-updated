<?php

namespace App\Http\Controllers;

use Alert;
use App\User;
use Validator;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EscalationLevel;
use App\Models\EscalationMatrix;
use Illuminate\Support\Facades\Input;

class EscalationMatrixController extends Controller
{
    public function index()
    {
        $escalation_metrix = EscalationMatrix::with(['user', 'department', 'escalation_level'])->get();

        // dd($escalation_metrix);

        return view('escalation_matrix.index', get_defined_vars());
    }

    public function create()
    {
        $users = User::all()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id');
        $escalation_levels = EscalationLevel::all()->pluck('name', 'id');

        return view('escalation_matrix.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        $input = Input::all();
	    $rules = [
	    	'department_id' => 'required',
	    	'escalation_level_id' => 'required',
	    	'user_id' => 'required',
	    	'to_or_cc' => 'required',
	    ];
	    $messages = [
            'department_id.required' => 'The Department is required',
            'escalation_level_id.required' => 'The Escalation Level is required',
            'user_id.required' => 'The assign to field is required',
            'to_or_cc.required' => 'This field is required',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $escalation_matrix = new EscalationMatrix;
        $escalation_matrix->escalation_level_id = $request['escalation_level_id'];
        $escalation_matrix->department_id = $request['department_id'];
        $escalation_matrix->user_id = $request['user_id'];
        $escalation_matrix->to_or_cc = $request['to_or_cc'];
        $escalation_matrix->save();

        Alert::success('Success', 'Successfully Created');

        return redirect('escalation-matrix');
    }

    public function edit(EscalationMatrix $escalation_matrix)
    {
        $users = User::all()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id');
        $escalation_levels = EscalationLevel::all()->pluck('name', 'id');

        return view('escalation_matrix.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {

        $escalation_matrix = EscalationMatrix::findOrFail($id);

        $input = Input::all();
	    $rules = [
	    	'department_id' => 'required',
	    	'escalation_level_id' => 'required',
	    	'user_id' => 'required',
	    	'to_or_cc' => 'required',
	    ];
	    $messages = [
            'department_id.required' => 'The Department is required',
            'escalation_level_id.required' => 'The Escalation Level is required',
            'user_id.required' => 'The assign to field is required',
            'to_or_cc.required' => 'This field is required',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $escalation_matrix->escalation_level_id = $request['escalation_level_id'];
        $escalation_matrix->department_id = $request['department_id'];
        $escalation_matrix->user_id = $request['user_id'];
        $escalation_matrix->to_or_cc = $request['to_or_cc'];
        $escalation_matrix->save();

        Alert::success('Success', 'Successfully Updated');

        return redirect('escalation-matrix');
    }

    public function destroy($id)
    {
        try {
            EscalationMatrix::findOrFail($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }
}
