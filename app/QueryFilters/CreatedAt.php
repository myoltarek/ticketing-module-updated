<?php

namespace App\QueryFilters;

use Illuminate\Support\Facades\Auth;

class CreatedAt extends Filter
{
    protected function applyFilter($builder)
    {
        if(!Auth::guest()) {
            $userID = Auth::id();
            if(Auth::user()->isAdmin){
                return $builder->whereDate('created_at', request($this->filterName()))->with($this->relationship());
            }else{
                return $builder->where('user_id', $userID)->whereDate('created_at', request($this->filterName()))->with($this->relationship());
            }
        }else{
            return $builder->whereDate('created_at', request($this->filterName()))->with($this->relationship());
        }
    }


    protected function relationship()
    {
        return [
            'crm',
            'crm.district',
            'crm.district.division',
            'crm.department',
            'crm.query_type',
            'crm.complain_type',
            'crm.call_remark'
        ];
    }
}
