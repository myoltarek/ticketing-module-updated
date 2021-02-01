<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignTicket extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
