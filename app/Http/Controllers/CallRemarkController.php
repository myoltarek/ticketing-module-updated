<?php

namespace App\Http\Controllers;

use App\Http\Requests\CallRemarksFormValidation;
use Illuminate\Http\Request;
use App\Models\CallRemark;
use Illuminate\Support\Facades\Input;
use Alert;
use Validator;

class CallRemarkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $call_remarks = CallRemark::get();
        return view('call_remarks.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('call_remarks.create');
    }

    public function store(CallRemarksFormValidation $request)
    {
        $call_remark = new CallRemark;
        $this->dataStore($call_remark,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('call-remarks');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $call_remark = CallRemark::find($id);

        return view('call_remarks.edit', get_defined_vars());
    }

    public function update(CallRemarksFormValidation $request, $id)
    {
        $call_remark = CallRemark::find($id);
        $this->dataStore($call_remark,$request);


        Alert::success('Success', 'Successfully Updated');

        return redirect('call-remarks');
    }

    public function destroy($id)
    {
        try {
            CallRemark::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');

        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }

    protected function dataStore($call_remark,$request)
    {
        $call_remark->name = $request->name;
        $call_remark->save();
    }
}
