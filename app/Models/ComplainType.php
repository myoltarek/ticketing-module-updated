<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplainType extends Model
{
    protected $table = 'complain_types';

    protected $fillable = ['name'];

    public function crm()
    {
        return $this->hasMany(Crm::class);
    }
}
