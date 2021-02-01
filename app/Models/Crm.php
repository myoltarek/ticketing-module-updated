<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crm extends Model
{
    protected $table = 'crms';

    public function division()
    {
    	return $this->belongsTo(Division::class, 'division_id');
    }

    public function district()
    {
    	return $this->belongsTo(District::class, 'district_id');
    }

    public function department()
    {
    	return $this->belongsTo(Department::class, 'department_id');
    }

    public function query_type()
    {
    	return $this->belongsTo(QueryType::class, 'query_type_id');
    }

    public function complain_type()
    {
    	return $this->belongsTo(ComplainType::class, 'complain_type_id');
    }

    public function call_remark()
    {
    	return $this->belongsTo(CallRemark::class, 'call_remark_id');
    }

    public function ticket()
    {
        return $this->hasOne(Ticket::class);
    }
}
