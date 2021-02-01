<?php


namespace App\Repositories;


use App\Models\Ticket;
use Auth;
use App\Exports\TicketsExport;

class TicketRepository implements TicketRepositoryInterface
{
    public function all($request)
    {
        $userID = Auth::id();
        if(Auth::user()->isAdmin){
            return Ticket::where('status', strtoupper($request->type))->with($this->relationship())->get();
        }else{

            return Ticket::where('user_id', $userID)->where('status', strtoupper($request->type))->with($this->relationship())->get();
        }
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

    protected function relationship()
    {
        return [
            'crm',
            'crm.district',
            'crm.district.division',
            'crm.department',
            'crm.query_type',
            'crm.complain_type',
            'crm.call_remark'
        ];
    }
}
