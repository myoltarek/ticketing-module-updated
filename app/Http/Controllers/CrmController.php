<?php

namespace App\Http\Controllers;

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

    public function index()
    {
        $crms = Crm::with('district','district.division','query_type','complain_type','department','call_remark')->get();

        return view('crms.index', get_defined_vars());
    }
    public function create(Request $request)
    {
        $departments = Department::orderBy('name', 'asc')->pluck('name', 'id');
        $districts = District::orderBy('name', 'asc')->pluck('name', 'id');
        $query_types = QueryType::orderBy('name', 'asc')->pluck('name', 'id');
        $complain_types = ComplainType::orderBy('name', 'asc')->pluck('name', 'id');
        $call_remarks = CallRemark::orderBy('name', 'asc')->pluck('name', 'id');
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
        $input = Input::all();
	    $rules = [
            'customer_name' => 'required',
            'customer_contact' => 'required',
            'agent_name' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'profession' => 'required',
            'query_type_id' => 'required',
            'department_id' => 'required',
            'complain_type_id' => 'required',
            'call_remark_id' => 'required',
	    ];
	    $messages = [
            'customer_name.required' => 'The Customer Name Field is required.',
            'customer_contact.required' => 'The Customer Contact is required',
            'agent_name.required' => 'The Agent Name is required',
            'district_id.required' => 'The District Field is required',
            'address.required' => 'The Address Field is required',
            'profession.required' => 'The Profession Field is required',
            'query_type_id.required' => 'The Query Field is required',
            'department_id.required' => 'The Department Field is required',
            'complain_type_id.required' => 'The Complain Field is required',
            'call_remark_id.required' => 'The Call Remark Field is required'
        ];

        $validator = Validator::make($input, $rules, $messages);
        if($validator->fails()){
            return redirect()->back()
                            ->with('error','Something wrong!')
                            ->withErrors($validator)
                            ->withInput();
        }

        if($request->raiseTicket == 'yes')
        {
            $escalation = AssignTicket::where('department_id', $request->department_id)->with('user')->first();
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

            $ticket = new Ticket;
            $ticket->crm_id = $crm->id;
            $ticket->user_id = $escalation->user_id;
            $ticket->status = 'NEW';
            // dd($escalation);
            $ticket->save();

            $ticket_details = Ticket::where('id', $ticket->id)->with(['crm','crm.district','crm.district.division','crm.department','crm.query_type','crm.complain_type','crm.call_remark'])->first();
            $assigned_user = User::where('id', $escalation->user_id)->first();
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

            return redirect()->back()->with('success','CRM & Ticket saved successfully!');
        }else {
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
}
