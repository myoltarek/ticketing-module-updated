<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTicketMail extends Mailable
{
    use Queueable, SerializesModels;


    public $ticketDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->ticketDetails = $data;
        // dd($this->ticketDetails);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Escalation Ticket')->markdown('emails.ticket_mails.OldTicketNotifyMail');
    }
}
