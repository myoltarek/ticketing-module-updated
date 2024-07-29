<?php


namespace App\QueryFilters;

use Illuminate\Support\Facades\Auth;

class TicketType extends Filter
{
    protected function applyFilter($builder)
    {
        if(!Auth::guest()){
            $userID = Auth::id();
            if(Auth::user()->isAdmin){
                return $builder->where('status', strtoupper(request($this->filterName())))->with($this->relationship());
            }else{
                return $builder->where('user_id', $userID)->where('status', strtoupper(request($this->filterName())))->with($this->relationship());
            }
        }else{
            return $builder->where('status', strtoupper(request($this->filterName())))->with($this->relationship());
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
