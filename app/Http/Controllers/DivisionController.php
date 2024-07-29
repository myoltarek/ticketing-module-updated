<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use Alert;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\DivisionFormValidation;

class DivisionController extends Controller
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
        $divisions = Division::all();

        return view('divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionFormValidation $request)
    {
        $division = new Division;
        $this->dataStore($division,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('division');
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
        $division = Division::find($id);

        return view('divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DivisionFormValidation $request, $id)
    {
        $division = Division::find($id);
        $this->dataStore($division,$request);

        Alert::success('Success', 'Successfully updated');
        return redirect('division');
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
            Division::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');

          } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
          }
    }

    protected function dataStore($division,$request)
    {
        $division->name = $request->name;
        $division->save();
    }
}
