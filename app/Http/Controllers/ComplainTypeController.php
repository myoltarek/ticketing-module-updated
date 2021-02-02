<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplainTypeFormValidation;
use Illuminate\Http\Request;
use App\Models\ComplainType;
use Illuminate\Support\Facades\Input;
use Alert;
use Validator;

class ComplainTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $complain_types = ComplainType::get();
        return view('complain_types.index', get_defined_vars());
    }

    public function create()
    {
        return view('complain_types.create');
    }

    public function store(ComplainTypeFormValidation $request)
    {
        $complain_type = new ComplainType;
        $this->dataStore($complain_type,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('complain-type');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $complain_type = ComplainType::find($id);

        return view('complain_types.edit', get_defined_vars());
    }

    public function update(ComplainTypeFormValidation $request, $id)
    {
        $complain_type = ComplainType::find($id);
        $this->dataStore($complain_type,$request);

        Alert::success('Success', 'Successfully Updated');

        return redirect('complain-type');
    }

    public function destroy($id)
    {
        try {
            ComplainType::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');

        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }

    protected function dataStore($complain_type, $request){
        $complain_type->name = $request->name;
        $complain_type->save();
    }
}
