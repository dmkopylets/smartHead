<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Support\Validation\TicketRules;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {

        return view('dashboard.admin.customers.index');
    }

     public function edit(Customer $customer)
    {

        return view('dashboard.admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate(TicketRules::public());
        $customer->update($validated);

        return redirect()
            ->route('admin.customer.index')
            ->with('success', "Customer #{$customer->id} updated successfully.");
    }
}
