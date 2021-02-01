<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = "divisions";

    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
