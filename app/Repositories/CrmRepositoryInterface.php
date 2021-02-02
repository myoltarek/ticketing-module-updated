<?php

namespace App\Repositories;

interface CrmRepositoryInterface
{
    public function getallDistrict();

    public function getallQueryType();

    public function getallComplainType();

    public function getallCallRemarks();

    public function getallDepartments();

    public function getTicketDetails($ticket);

    public function getAssignUser($escalation);
}
