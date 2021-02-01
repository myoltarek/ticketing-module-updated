<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();

        $rules = [
            'name' => 'required'
        ];

        $message = [
            'name.required' => 'Query Name is required'
        ];

        $validator = Validator::make($input, $rules, $message);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $call_remark = new CallRemark;
        $call_remark->name = $request->name;
        $call_remark->save();

        Alert::success('Success', 'Successfully Created');

        return redirect('call-remarks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $call_remark = CallRemark::find($id);

        return view('call_remarks.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $call_remark = CallRemark::find($id);

        $input = Input::all();

        $rules = [
            'name' => 'required'
        ];

        $message = [
            'name.required' => 'Query Name is required'
        ];

        $validator = Validator::make($input, $rules, $message);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');

            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $call_remark->name = $request->name;
        $call_remark->save();

        Alert::success('Success', 'Successfully Updated');

        return redirect('call-remarks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
