<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Ticket extends Model
{
    protected $table = 'tickets';

    public function crm()
    {
        return $this->belongsTo(Crm::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function ticket_response()
    {
        return $this->hasMany(TicketResponse::class);
    }

    public static function allTickets()
    {
        return app(Pipeline::class)
            ->send(Ticket::query())
            ->through([
                \App\QueryFilters\TicketType::class,
                \App\QueryFilters\CreatedAt::class,
                \App\QueryFilters\TicketId::class,
            ])
            ->thenReturn()
            ->get();
    }
}
