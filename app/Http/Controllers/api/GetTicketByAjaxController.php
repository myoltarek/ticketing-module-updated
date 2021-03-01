<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TicketRepositoryInterface;
use Response;

class GetTicketByAjaxController extends Controller
{
    private $ticketRepoisitory;

    public function __construct(TicketRepositoryInterface $ticketRepoisitory)
    {
        $this->ticketRepoisitory = $ticketRepoisitory;
    }
    public function getTicket(Request $request)
    {
        $tickets = $this->ticketRepoisitory->all($request);

        logger($tickets);

        return response()->json($tickets);

    }

    public function getTicketById(Request $request)
    {
        logger($request->all());

        $ticket = $this->ticketRepoisitory->findById($request->ticket_id);
        foreach($ticket->ticket_response as $response){
            $response->created_time = \Carbon\Carbon::parse($response->created_at)->toTimeString();
            $response->created_date = \Carbon\Carbon::parse($response->created_at)->format('d/m/Y');
        }


        return response()->json($ticket);
    }

    public function ticketCloseById(Request $request)
    {
        $ticket = $this->ticketRepoisitory->changeTicketStatus($request,$request->ticket_id);
        $ticket->save();

        return response()->json($ticket);
    }
}
