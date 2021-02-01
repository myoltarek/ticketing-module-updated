<?php

namespace App\Http\Controllers;

use App\Repositories\TicketRepositoryInterface;
use Auth;
use Alert;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TicketController extends Controller
{

    /**
     * @var TicketRepository
     */
    private $ticketRepoisitory;

    public function __construct(TicketRepositoryInterface $ticketRepoisitory)
    {
        $this->middleware('auth');
        $this->ticketRepoisitory = $ticketRepoisitory;
    }

    public function index(Request $request)
    {
        $tickets = $this->ticketRepoisitory->all($request);

        $status_for_display = $request->type;
        return view("tickets.index", get_defined_vars());
    }

    public function show($id)
    {
        $ticket = $this->ticketRepoisitory->findById($id);
        return view('tickets.show', get_defined_vars());
    }

    public function changeStatus(Request $request,$id)
    {
        $ticket = $this->ticketRepoisitory->changeTicketStatus($request,$id);

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

        $export = $this->ticketRepoisitory->downloadTicket($request);

        return Excel::download($export, 'tickets.xlsx');
    }
}
