<?php


namespace App\Repositories;


use App\Models\Ticket;
use Auth;
use App\Exports\TicketsExport;
use Illuminate\Pipeline\Pipeline;

class TicketRepository implements TicketRepositoryInterface
{
    public function all($request)
    {
        return Ticket::allTickets();
    }

    public function findById($id)
    {
        return Ticket::where('id', $id)->with($this->relationship())->firstOrFail();
    }

    public function changeTicketStatus($request,$id)
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


        return $ticket;
    }

    public function downloadTicket($request)
    {
        return new TicketsExport([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type
        ]);
    }
}
