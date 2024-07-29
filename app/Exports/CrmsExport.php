<?php

namespace App\Exports;

use App\Models\Crm;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CrmsExport implements FromCollection, Responsable, WithMapping, WithHeadings
{
    use Exportable;
    protected $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $start_date = $this->request['start_date'].' '."00:00:00";
        $end_date = $this->request['end_date'].' '."23.59.59";
        return Crm::whereBetween('created_at',[$start_date,$end_date])
                    ->with('district','district.division','query_type','complain_type','department','call_remark')->get();
    }

    public function map($crm): array
    {
        return [
            $crm->id,
            $crm->agent_name,
            $crm->customer_name,
            $crm->customer_contact,
            $crm->alternate_number,
            $crm->customer_gender,
            $crm->wing_name,
            $crm->dealer_division,
            $crm->area,
            $crm->territory,
            $crm->region,
            $crm->designation,
            $crm->distributor_name,
            $crm->proprietor_name,
            $crm->verification_code,
            $crm->caller_type,
            $crm->call_type,
            $crm->address,
            $crm->query_type->name,
            $crm->complain_type->name,
            $crm->department->name,
            $crm->district->name,
            $crm->district->division->name,
            $crm->verbatim,
        ];
    }

    public function headings(): array
    {
        return [
            'Crm Id',
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
        ];
    }
}
