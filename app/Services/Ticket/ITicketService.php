<?php 


namespace App\Services\Ticket;
use App\Services\IBaseService;
use Illuminate\Http\Request;

interface ITicketService extends IBaseService
{
    public function store(Request $request);

    public function updateTicketAndResponse(Request $request);
}
