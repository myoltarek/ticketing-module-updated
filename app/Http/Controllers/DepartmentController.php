<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentFormValidation;
use Illuminate\Http\Request;
use App\Models\Department;
use Validator;
Use Alert;
use Illuminate\Support\Facades\Input;


class DepartmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $departments = Department::all();

        return view('departments.index', compact('departments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentFormValidation $request)
    {
        $department = new Department;
        $this->dataStore($department,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('department');

    }


    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('departments.edit', compact('department'));
    }

    public function update(DepartmentFormValidation $request, $id)
    {
        $department = Department::findOrFail($id);
        $this->dataStore($department,$request);

        Alert::success('Success', 'Successfully updated');
        return redirect('department');
    }



    public function destroy($id)
    {
        try {
            Department::findOrFail($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }

    protected function dataStore($department,$request)
    {
        $department->name = $request->name;
        $department->save();
    }
}
