<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use Validator;
Use Alert;
use Illuminate\Support\Facades\Input;

class DistrictController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $districts = District::with('division')->get();
        // $patient = Patient::with('doctor')->where('doctor_id',$request->doctor_id)->where('date', date('Y-m-d'))->get();
        logger($districts);

        return view('districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all()->pluck('name', 'id');
        
        return view('districts.create', compact('divisions'));
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
            'name' => 'required',
            'division_id' => 'required'
	    ];
	    $messages = [
            'name.required' => 'The district field is required.',
            'division_id.required' => 'The Division Field is required'
        ];
	    
        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $district = new District;
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();

        Alert::success('Success', 'Successfully Created');

        return redirect('district');
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
    public function edit(District $district)
    {
        $divisions = Division::all()->pluck('name','id');
        return view('districts.edit', get_defined_vars());
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
        $district = District::find($id);
        
        $input = Input::all();
	    $rules = [
            'name' => 'required',
            'division_id' => 'required'
	    ];
	    $messages = [
            'name.required' => 'The District field is required.',
            'division_id.required' => 'The Division Field is required'
        ];
	    
    	$validator = Validator::make($input, $rules, $messages);

        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $district->name = $request->name;

        $district->save();
        Alert::success('Success', 'Successfully updated');
        return redirect('district');
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
            District::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }
}
