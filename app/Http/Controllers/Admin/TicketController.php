<?php 


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Ticket\ITicketService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Repositories\Ticket\ITicketRepository;
use Exception;

class TicketController extends Controller
{

    public function __construct(
        private ITicketService $ticketService,
        private ITicketRepository $ticketRepository,
    )
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
     public function index(): View
    {
        $data = $this->ticketService->findAllWithPagination([], [], 10);
        return view('admin.ticket.index')->with([
            'data' => $data
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.ticket.create')->with([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @return RedirectResponse
     */
    public function store(CreateTicketRequest $request): RedirectResponse
    {
        try {
            $response = $this->ticketService->create($request->all());

            if ($response) {
                return redirect()->back()->with('success', 'Ticket added successfully.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }

        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return View
     */
    public function show(string $id): View
    {
        try {
            $response = $this->ticketRepository->findByIdWithRelations($id);
            return view('admin.ticket.show')->with([
                'data' => $response,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Some thing Went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateTicketRequest $request): RedirectResponse
    {
        try {
            $this->ticketService->updateTicketAndResponse($request);

            return redirect()->back()->with('success', 'Ticket updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong while updating.');
        }
    }
}
