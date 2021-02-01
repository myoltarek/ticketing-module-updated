<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EscalationMatrix extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function escalation_level()
    {
        return $this->belongsTo(EscalationLevel::class);
    }
}
