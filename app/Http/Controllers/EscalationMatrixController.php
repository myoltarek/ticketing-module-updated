<?php

namespace App\Http\Controllers;

use Alert;
use App\Http\Requests\EscalationMatrixFormValidation;
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
        return view('escalation_matrix.create', get_defined_vars());
    }

    public function store(EscalationMatrixFormValidation $request)
    {
        $escalation_matrix = new EscalationMatrix;
        $this->dataStore($escalation_matrix,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('escalation-matrix');
    }

    public function edit(EscalationMatrix $escalation_matrix)
    {
        return view('escalation_matrix.edit', get_defined_vars());
    }

    public function update(EscalationMatrixFormValidation $request, $id)
    {

        $escalation_matrix = EscalationMatrix::findOrFail($id);
        $this->dataStore($escalation_matrix,$request);

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

    protected function dataStore($escalation_matrix,$request)
    {
        $escalation_matrix->escalation_level_id = $request['escalation_level_id'];
        $escalation_matrix->department_id = $request['department_id'];
        $escalation_matrix->user_id = $request['user_id'];
        $escalation_matrix->to_or_cc = $request['to_or_cc'];
        $escalation_matrix->save();

    }
}
