<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallRemark extends Model
{
    protected $table = 'call_remarks';

    protected $fillable = ['name'];

    public function crm()
    {
        return $this->hasMany(Crm::class);
    }
}
