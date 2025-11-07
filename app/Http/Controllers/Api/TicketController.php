<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\+[1-9]\d{6,14}$/'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ], [
            'phone.regex' => 'The telephone number must be in E.164 format, e.g. +380971234567',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $customer = Customer::firstOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'phone' => $request->phone,
            ]
        );

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'new',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Application successfully created!',
            'data' => [
                'ticket_id' => $ticket->id,
                'customer_id' => $customer->id,
            ],
        ], 201);
    }
}
