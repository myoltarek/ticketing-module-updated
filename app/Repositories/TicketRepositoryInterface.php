<?php

namespace App\Repositories;

interface TicketRepositoryInterface
{
    public function all($request);

    public function findById($id);

    public function changeTicketStatus($request, $id);

    public function downloadTicket($request);
}
