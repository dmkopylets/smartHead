<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CustomerRepository;

class TicketService
{
    protected CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function create(array $data): array
    {
        $customerData = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ];

        $customer = $this->customerRepository->upsert($customerData);

        $ticket = Ticket::create([
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'new',
        ]);

        return [
            'ticket_id' => $ticket->id,
            'customer_id' => $customer->id,
        ];
    }
}
