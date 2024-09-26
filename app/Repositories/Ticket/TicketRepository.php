<?php 


namespace App\Repositories\Ticket;

use App\Models\Ticket;
use App\Repositories\BaseRepository;

class TicketRepository extends BaseRepository implements ITicketRepository
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    public function findByIdWithRelations($id)
    {
        return $this->model->with('response')->find($id);
    }
}
