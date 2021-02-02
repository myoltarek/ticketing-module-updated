<?php

namespace App\Http\Controllers;

use App\Repositories\CrmRepository;
use App\Repositories\CrmRepositoryInterface;
use App\User;
use Validator;
use App\Models\Crm;

use App\Http\Requests;
// use App\Models\Option;
use App\Models\Ticket;
use App\Models\District;
use App\Models\QueryType;
use App\Models\CallRemark;
use App\Models\Department;
use App\Exports\CrmsExport;
use App\Mail\NewTicketMail;
use App\Models\ComplainType;
use Illuminate\Http\Request;
Use Alert;
use App\Jobs\SendTicketEmail;
use App\Models\AssignTicket;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class CrmController extends Controller
{

    /**
     * @var CrmRepository
     */
    private $crmRepository;

    public function __construct(CrmRepositoryInterface $crmRepository)
    {

        $this->crmRepository = $crmRepository;
    }

    public function index()
    {
        $crms = Crm::with('district','district.division','query_type','complain_type','department','call_remark')->get();

        return view('crms.index', get_defined_vars());
    }
    public function create(Request $request)
    {
        $districts = $this->crmRepository->getallDistrict();
        $query_types = $this->crmRepository->getallQueryType();
        $complain_types = $this->crmRepository->getallComplainType();
        $call_remarks = $this->crmRepository->getallCallRemarks();
        $departments = $this->crmRepository->getallDepartments();

        $phone_number = substr($request->phone_number, -11);
        $phoneNumber = $phone_number;
        $agent = $request->agent;

        $crmLast = Crm::whereIn('customer_contact', [substr($request->phone_number, -11), substr($request->phone_number, -10)])->orderBy('id', 'desc')->first();

        return view('crms.create', compact('districts','departments', 'phoneNumber', 'agent', 'crmLast', 'query_types', 'complain_types', 'call_remarks'));
    }

    public function getDistrict(Request $request)
    {
        $districts = District::where('division_id', $request->division_id)->pluck('name', 'id');
        return response()->json($districts);
    }

    public function store(Request $request)
    {
        dd($request->all());
        if($request->raiseTicket == 'yes')
        {
            $escalation = AssignTicket::where('department_id', $request->department_id)->with('user')->first();
            $crm = $this->storeCrmData($request);
            $ticket = $this->storeTicketData($crm,$escalation);

            $this->sendMailToAssignPerson($ticket,$escalation);

            return redirect()->back()->with('success','CRM & Ticket saved successfully!');
        }else {
            $this->storeCrmData($request);
            return redirect()->back()->with('success','CRM saved successfully!');
        }
    }

    public function searchByDate(Request $request)
    {
        logger($request);
    }

    public function downloadPanel()
    {
        return view('crms.downloadPanel');
    }

    public function download(Request $request)
    {
            $export = new CrmsExport([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
        ]);

        return Excel::download($export, 'crms.xlsx');
    }

    public function storeCrmData($request)
    {
        $crm = new Crm;
        $crm->customer_contact = $request->customer_contact;
        $crm->agent_name = $request->agent_name;
        $crm->customer_name = $request->customer_name;
        $crm->district_id = $request->district_id;
        $crm->address = $request->address;
        $crm->profession = $request->profession;
        $crm->query_type_id = $request->query_type_id;
        $crm->department_id = $request->department_id;
        $crm->complain_type_id = $request->complain_type_id;
        $crm->call_remark_id = $request->call_remark_id;
        $crm->verbatim = $request->verbatim;
        $crm->save();
    }

    public function storeTicketData($crm,$escalation)
    {
        $ticket = new Ticket;
        $ticket->crm_id = $crm->id;
        $ticket->user_id = $escalation->user_id;
        $ticket->status = 'NEW';
        $ticket->save();
    }

    public function sendMailToAssignPerson($ticket,$escalation)
    {
        $ticket_details = $this->crmRepository->getTicketDetails($ticket);
//        $ticket_details = Ticket::where('id', $ticket->id)->with(['crm','crm.district','crm.district.division','crm.department','crm.query_type','crm.complain_type','crm.call_remark'])->first();
        $assigned_user = $this->crmRepository->getAssignUser($escalation);
        $data = [
            'ticket_id' => $ticket_details->id,
            'crm_id' => $ticket_details->crm_id,
            'ticket_status' => $ticket_details->status,
            'created_at' => $ticket_details->created_at,
            'assigned_person' => $assigned_user->name,
            'agent_name' => $ticket_details->crm->agent_name,
            'customer_name' => $ticket_details->crm->customer_name,
            'customer_contact' => $ticket_details->crm->customer_contact,
            'customer_division' => $ticket_details->crm->district->division->name,
            'customer_district' => $ticket_details->crm->district->name,
            'customer_address' => $ticket_details->crm->address,
            'customer_profession' => $ticket_details->crm->profession,
            'department' => $ticket_details->crm->department->name,
            'query_type' => $ticket_details->crm->query_type->name,
            'complain_type' => $ticket_details->crm->complain_type->name,
            'call_remark' => $ticket_details->crm->call_remark->name,
            'verbatim' => $ticket_details->crm->verbatim
        ];
        //start of cc for supervisor
        // $super_CC = "navid@myolbd.com";
        // end of cc for supervisor
        Mail::to($escalation->user)
            // ->cc([$escalation->mail_cc,$super_CC])
            ->cc($escalation->mail_cc)
            ->send(new NewTicketMail($data));
        // SendTicketEmail::dispatch($escalation->user, $data);
    }
}
