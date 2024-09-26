<?php 


namespace App\Repositories\Ticket;

use App\Repositories\IBaseRepository;

interface ITicketRepository extends IBaseRepository
{
    public function findByIdWithRelations($id);
}
