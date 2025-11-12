<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Ticket;
use App\Support\Validation\TicketRules;
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

     public function edit(Ticket $ticket)
    {
        $customers = Customer::asOptions();

        return view('dashboard.manager.tickets.edit', compact('ticket', 'customers'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate(TicketRules::manager());
        $ticket->update($validated);

        return redirect()
            ->route('manager.tickets.index')
            ->with('success', "Ticket #{$ticket->id} updated successfully.");
    }
}
