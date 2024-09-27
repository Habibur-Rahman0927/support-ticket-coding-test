<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTicketRequest;
use App\Models\Ticket;
use App\Repositories\Ticket\ITicketRepository;
use App\Services\Ticket\ITicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     */
    public function index()
    {
        $data = $this->ticketService->findAll(['user_id' => Auth::id()]);
        return view('customer.ticket.index')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request)
    {
        try {
            $this->ticketService->store($request);
            return redirect()->route('ticket.index')->with('success', 'Ticket created successfully!');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ticket creation failed. Please try again later.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $response = $this->ticketRepository->findByIdWithRelations($id);
            return view('customer.ticket.show')->with([
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Some thing Went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
