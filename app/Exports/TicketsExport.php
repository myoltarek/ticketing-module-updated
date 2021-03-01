<?php

namespace App\Exports;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketsExport implements FromCollection, Responsable, WithMapping, WithHeadings
{

    use Exportable;
    protected $request;

    public function __construct(array $request){
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $start_date = $this->request['start_date'].' '."00:00:00";
        $end_date = $this->request['end_date'].' '."23.59.59";
        $userID = Auth::id();
        if(Auth::user()->isAdmin){
            if($this->request['type'] == 'ALL'){
                // logger('inside all');
                $abc = Ticket::whereBetween('created_at',[$start_date,$end_date])
                            ->with(['crm','crm.query_type','crm.complain_type','crm.call_remark','crm.department','crm.district','crm.district.division'])->get();
                // logger($abc);
                return $abc;
            }else{
                return Ticket::where('status', $this->request['type'])
                            ->whereBetween('created_at',[$start_date,$end_date])
                            ->with(['crm','crm.query_type','crm.complain_type','crm.call_remark','crm.department','crm.district','crm.district.division'])->get();
            }
        }else{
            if($this->request['type'] == 'ALL'){
                return Ticket::whereBetween('created_at',[$start_date,$end_date])
                            ->with(['crm','crm.query_type','crm.complain_type','crm.call_remark','crm.department','crm.district','crm.district.division'])->get();
            }else{
                return Ticket::where('user_id', $userID)
                            ->where('status', $this->request['type'])
                            ->whereBetween('created_at',[$start_date,$end_date])
                            ->with(['crm','crm.query_type','crm.complain_type','crm.call_remark','crm.department','crm.district','crm.district.division'])->get();
            }
        }
    }

    public function map($ticket): array
    {
        return [
            $ticket->id,
            $ticket->crm->agent_name,
            $ticket->crm->customer_name,
            $ticket->crm->customer_contact,
            $ticket->crm->alternate_number,
            $ticket->crm->customer_gender,
            $ticket->crm->wing_name,
            $ticket->crm->dealer_division,
            $ticket->crm->area,
            $ticket->crm->territory,
            $ticket->crm->region,
            $ticket->crm->designation,
            $ticket->crm->distributor_name,
            $ticket->crm->proprietor_name,
            $ticket->crm->verification_code,
            $ticket->crm->caller_type,
            $ticket->crm->call_type,
            $ticket->crm->address,
            $ticket->crm->query_type->name,
            $ticket->crm->complain_type->name,
            $ticket->crm->department->name,
            $ticket->crm->district->name,
            $ticket->crm->district->division->name,
            $ticket->crm->verbatim,
            $ticket->status,
            $ticket->comment
        ];
    }

    public function headings(): array
    {
        return [
            'Ticket Id',
            'Agent Name',
            'Customer Name',
            'Customer Phone No',
            'Alternate Phone No',
            'Customer Gender',
            'Wing',
            'Dealer Division',
            'Area',
            'Territory',
            'Region',
            'Designation',
            'Distributor Name',
            'Proprietor Name',
            'Verification Code',
            'Caller Type',
            'Call Type',
            'Customer Address',
            'Query Type',
            'Complain Type',
            'Department Name',
            'District',
            'Division',
            'Verbatim',
            'Ticket Status',
            'Comment on Ticket',
        ];
    }
}
