<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
