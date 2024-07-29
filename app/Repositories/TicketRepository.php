<?php


namespace App\Repositories;


use App\Models\Ticket;
use App\Exports\TicketsExport;
use App\Models\TicketResponse;
use Illuminate\Support\Facades\Auth;

class TicketRepository implements TicketRepositoryInterface
{
    public function all($request)
    {
        return Ticket::allTickets();
    }

    public function findById($id)
    {
        // dd(Ticket::where('id', $id)->with($this->relationship())->firstOrFail());
        return Ticket::where('id', $id)->with($this->relationship())->firstOrFail();
    }

    public function changeTicketStatus($request,$id)
    {
        $ticket = Ticket::find($id);
        logger($ticket);
        if($request->action === 'Send to next step'){
            switch ($ticket->status) {
                case "NEW":
                    $ticket->status = "wip";
                    if($request->comment){
                        $this->saveResponse($ticket, $request);
                    }
                    break;
                case "WIP":
                    $ticket->status = "answered";
                    if($request->comment){
                        $this->saveResponse($ticket, $request);
                    }
                    break;
                case "ANSWERED":
                    $ticket->status = "closed";
                    if($request->comment){
                        $this->saveResponse($ticket, $request);
                    }
                    break;
                default:
                    $ticket->status = "wip";
                    if($request->comment){
                        $this->saveResponse($ticket, $request);
                    }
            }
        }else{
            $ticket->status = "closed";
            if($request->comment){
                $this->saveResponse($ticket, $request);
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

    protected function saveResponse($ticket, $request){

        $userID = Auth::id();
        $ticketResponse = new TicketResponse;
        $ticketResponse->user_id = $userID;
        $ticketResponse->ticket_id = $ticket->id;
        $ticketResponse->response = $request->comment;
        $ticketResponse->save();
    }

    protected function relationship()
    {
        return [
            'crm',
            'crm.district',
            'crm.district.division',
            'crm.department',
            'crm.query_type',
            'crm.complain_type',
            'crm.call_remark',
            'ticket_response',
            'ticket_response.user'
        ];
    }
}
