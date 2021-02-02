<?php

namespace App\Repositories;

use App\Models\CallRemark;
use App\Models\ComplainType;
use App\Models\Department;
use App\Models\District;
use App\Models\QueryType;
use App\Models\Ticket;
use App\User;

class CrmRepository implements CrmRepositoryInterface
{
    public function getallDistrict()
    {
        return District::orderBy('name', 'asc')->pluck('name', 'id');
    }

    public function getallQueryType()
    {
        return QueryType::orderBy('name', 'asc')->pluck('name', 'id');
    }

    public function getallComplainType()
    {
        return ComplainType::orderBy('name', 'asc')->pluck('name', 'id');
    }

    public function getallCallRemarks()
    {
        return CallRemark::orderBy('name', 'asc')->pluck('name', 'id');
    }

    public function getallDepartments()
    {
        return Department::orderBy('name', 'asc')->pluck('name', 'id');

    }

    public function getTicketDetails($ticket)
    {
        return Ticket::where('id', $ticket->id)->with(['crm','crm.district','crm.district.division','crm.department','crm.query_type','crm.complain_type','crm.call_remark'])->first();
    }

    public function getAssignUser($escalation)
    {
        return User::where('id', $escalation->user_id)->first();
    }
}
