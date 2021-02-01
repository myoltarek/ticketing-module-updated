<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QueryType;
use App\User;
use Validator;
Use Alert;
use App\Models\AssignTicket;
use App\Models\Department;
use Illuminate\Support\Facades\Input;

class AssignTicketController extends Controller
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
        $assign_tickets = AssignTicket::with('user','department')->get();
        return view('assign_tickets.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assign_tickets.create', get_defined_vars());
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
	    	'department_id' => 'required',
	    	'user_id' => 'required',
	    	'email' => 'email',
	    ];
	    $messages = [
            'department_id.required' => 'The query type field is required.',
            'user_id.required' => 'The assign to field is required.',
            'email.email' => 'Email is not valid.',
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            Alert::error('Error', 'Something wrong!');
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $assign_ticket = new AssignTicket;
        $assign_ticket->department_id = $request->department_id;
        $assign_ticket->user_id = $request->user_id;
        $assign_ticket->mail_cc = $request->mail_cc;
        $assign_ticket->save();

        Alert::success('Success', 'Successfully Created');

        return redirect('assign-tickets');
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
    public function edit(AssignTicket $assign_ticket)
    {
        return view('assign_tickets.edit', get_defined_vars());
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
        try {
            $input = Input::all();
            $rules = [
                'department_id' => 'required',
                'user_id' => 'required',
                'email' => 'email',
            ];
            $messages = [
                'department_id.required' => 'The query type field is required.',
                'user_id.required' => 'The assign to field is required.',
                'email.email' => 'Email is not valid.',
            ];

            $validator = Validator::make($input, $rules, $messages);
            if($validator->fails()){
                Alert::error('Error', 'Something wrong!');
                return redirect()->back()
                                ->withErrors($validator)
                                ->withInput();
            }

            $assign_ticket = AssignTicket::find($id);
            $assign_ticket->department_id = $request->department_id;
            $assign_ticket->user_id = $request->user_id;
            $assign_ticket->mail_cc = $request->mail_cc;
            $assign_ticket->save();

            Alert::success('Success', 'Successfully Updated');

            return redirect('assign-tickets');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }

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
            AssignTicket::find($id)->delete();
            return back()->with('success', 'Successfully Deleted!');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }
    }
}
