<?php 


namespace App\Repositories\TicketResponse;

use App\Models\TicketResponse;
use App\Repositories\BaseRepository;

class TicketResponseRepository extends BaseRepository implements ITicketResponseRepository
{
    public function __construct(TicketResponse $model)
    {
        parent::__construct($model);
    }
}
