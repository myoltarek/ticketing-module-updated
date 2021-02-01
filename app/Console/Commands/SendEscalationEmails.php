<?php

namespace App\Console\Commands;

use App\Mail\NotifyTicketMail;
use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\EscalationLevel;
use Illuminate\Console\Command;
use App\Models\EscalationMatrix;
use Illuminate\Support\Facades\Mail;

class SendEscalationEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:escalationEmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending escalation email notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $to_person = array();
        $cc_person = array();

        $escalation_levels = EscalationLevel::get();

        foreach($escalation_levels as $escalation_level){
            $query_date = $this->queryDate($escalation_level->days);
            $tickets = $this->getTickets($query_date);
            foreach($tickets as $ticket){
                $escalation_matrix = $this->getEscalation($ticket->crm->department_id);
                foreach($escalation_matrix as $mail_person){
                    if($mail_person->to_or_cc == 'to'){
                        array_push($to_person, $mail_person->user->email);
                    }else{
                        array_push($cc_person, $mail_person->user->email);
                    }

                }
                // dd($to_person);
                Mail::to($to_person)
                ->cc($cc_person)
                ->send(new NotifyTicketMail($ticket));
                // dd($cc_person);
            }
        }
    }

    public function queryDate($query_days)
    {
        return Carbon::today()->subDays($query_days)->toDateString();
    }

    public function getTickets($query_date)
    {
        return Ticket::where('status', 'NEW')->with(['user','crm','crm.department','crm.query_type','crm.complain_type','crm.call_remark','crm.district', 'crm.district.division'])->whereDate('created_at', $query_date)->get();
        // return Ticket::where('status', 'NEW')->with('crm')->whereBetween('created_at', [$query_date.' 00:00:00',$query_date.' 23:59:59'])->get();
    }

    public function getEscalation($department_id)
    {
        return EscalationMatrix::with('user')->where('department_id', $department_id)->get();
    }
}
