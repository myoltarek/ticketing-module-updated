<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
