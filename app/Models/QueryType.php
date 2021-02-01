<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueryType extends Model
{
    protected $table = 'query_types';

    protected $fillable = ['name'];

    public function escalation()
    {
        return $this->hasMany(Escalation::class);
    }

    public function crm()
    {
        return $this->hasMany(Crm::class);
    }
}
