<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Exports\TicketsExport;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userID = Auth::id();
        if(Auth::user()->isAdmin){
            $tickets = Ticket::where('status', strtoupper($request->type))->with(['crm','crm.query_type','crm.complain_type','crm.call_remark'])->get();
        }else{

            $tickets = Ticket::where('user_id', $userID)->where('status', strtoupper($request->type))->with(['crm','crm.query_type','crm.complain_type','crm.call_remark'])->get();
        }
        $status_for_display = $request->type;
        return view("tickets.index", get_defined_vars());
    }

    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->with(['crm','crm.district','crm.district.division','crm.department','crm.query_type','crm.complain_type','crm.call_remark'])->first();
        return view('tickets.show', get_defined_vars());
    }

    public function changeStatus(Request $request,$id)
    {
        $ticket = Ticket::find($id);

        switch ($ticket->status) {
            case "NEW":
                $ticket->status = "WIP";
                if($request->comment){
                    $ticket->comment = $request->comment;
                }
                break;
            case "WIP":
                $ticket->status = "ANSWERED";
                if($request->comment){
                    $ticket->comment = $request->comment;
                }
                break;
            case "ANSWERED":
                $ticket->status = "CLOSED";
                if($request->comment){
                    $ticket->comment = $request->comment;
                }
                break;
            default:
              $ticket->status = "WIP";
              if($request->comment){
                $ticket->comment = $request->comment;
            }
        }

        $ticket->save();

        Alert::success('Success', 'Ticket Status changed successfully');

        return redirect()->route('ticket',['type'=> $ticket->status]);
    }


    public function downloadPanel()
    {
        return view('tickets.downloadPanel');
    }

    public function download(Request $request)
    {

        $export = new TicketsExport([

                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => $request->type

        ]);

        return Excel::download($export, 'tickets.xlsx');
    }
}
