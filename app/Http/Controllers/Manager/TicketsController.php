<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStoreRequest;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Display a listing of the tickets.
     */
    public function index()
    {
        $customers = Customer::asOptions();

        return view('dashboard.manager.tickets.index', compact('customers'));
    }

    public function create()
    {
        $ticket = new Ticket();
        return view('dashboard.manager.tickets.create', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        return view('dashboard.manager.tickets.edit', compact('ticket'));
    }

    public function update(TicketStoreRequest $request, Ticket $ticket)
    {
        $ticket->fill($request->all())->save();

        $customers = Customer::asOptions();

        return view('dashboard.manager.tickets.index', compact('customers'));
    }

    public function store(TicketStoreRequest $request)
    {
        Ticket::create($request->validated());

        $customers = Customer::asOptions();

        return view('dashboard.manager.tickets.index', compact('customers'))
            ->with('success', "Created Successfully");
    }
}
