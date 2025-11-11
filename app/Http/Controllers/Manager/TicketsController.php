<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
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

        return view('dashboard.manager.index', compact('customers'));
    }
}
