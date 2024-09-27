<?php 


namespace App\Services\Ticket;

use App\Events\TicketCreated;
use App\Events\TicketUpdated;
use App\Jobs\CreateTicketNotification;
use App\Jobs\UpdateTicketNotification;
use App\Models\Ticket;
use App\Repositories\Ticket\ITicketRepository;
use App\Repositories\TicketResponse\ITicketResponseRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketService extends BaseService implements ITicketService
{
    public function __construct(private ITicketRepository $ticketRepository,
                                private ITicketResponseRepository $ticketResponseRepository
    )
    {
        parent::__construct($ticketRepository);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $userId = Auth::id();
            $data = [
                'user_id' => $userId,
                'subject' => $request->input('subject'),
                'description' => $request->input('description'),
                'status' => Ticket::STATUS_OPEN,
                'created_by' => $userId,
            ];

            $ticket = $this->create($data);
            // event(new TicketCreated($ticket));
            CreateTicketNotification::dispatch($ticket);
            DB::commit();
            return $ticket;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateTicketAndResponse(Request $request)
    {
        $userId = Auth::id();
        DB::beginTransaction();

        try {
            $ticket = $this->findById($request->input('id'));
            $ticket->status = $request->input('status');
            $ticket->save();

            $data = [
                'ticket_id' => $ticket->id,
                'user_id' => $userId,
                'response' => $request->input('response'),
                'created_by' => $userId,
                'updated_by' => $userId,
            ];
            // event(new TicketUpdated($ticket));
            UpdateTicketNotification::dispatch($ticket);

            $this->ticketResponseRepository->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
