<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTicketFormValidation;
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

    public function index()
    {
        $assign_tickets = AssignTicket::with('user','department')->get();
        return view('assign_tickets.index', get_defined_vars());
    }

    public function create()
    {
        return view('assign_tickets.create', get_defined_vars());
    }

    public function store(AssignTicketFormValidation $request)
    {
        $assign_ticket = new AssignTicket;
        $this->dataStore($assign_ticket,$request);

        Alert::success('Success', 'Successfully Created');

        return redirect('assign-tickets');
    }

    public function show($id)
    {
        //
    }

    public function edit(AssignTicket $assign_ticket)
    {
        return view('assign_tickets.edit', get_defined_vars());
    }

    public function update(AssignTicketFormValidation $request, $id)
    {
        try {
            $assign_ticket = AssignTicket::find($id);
            $this->dataStore($assign_ticket, $request);

            Alert::success('Success', 'Successfully Updated');

            return redirect('assign-tickets');
        } catch (\Illuminate\Database\QueryException $e) {
            Alert::error('Alert!!!', 'Sorry, something went wrong. You can not delete');
            return back();
        }

    }

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

    public function dataStore($assign_ticket, $request)
    {
        $assign_ticket->department_id = $request->department_id;
        $assign_ticket->user_id = $request->user_id;
        $assign_ticket->mail_cc = $request->mail_cc;
        $assign_ticket->save();
    }
}
