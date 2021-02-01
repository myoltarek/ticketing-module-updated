<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['name','division_id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function crm()
    {
        return $this->hasMany(Crm::class);
    }
}
