<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complain_types = ComplainType::get();
        return view('complain_types.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complain_types.create');
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

        $complain_type = new ComplainType;
        $complain_type->name = $request->name;
        $complain_type->save();

        Alert::success('Success', 'Successfully Created');

        return redirect('complain-type');
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
        $complain_type = ComplainType::find($id);

        return view('complain_types.edit', get_defined_vars());
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
        $complain_type = ComplainType::find($id);

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

        $complain_type->name = $request->name;
        $complain_type->save();

        Alert::success('Success', 'Successfully Updated');

        return redirect('complain-type');
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
            ComplainType::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
          
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }
}
