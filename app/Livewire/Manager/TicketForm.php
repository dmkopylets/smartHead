<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use App\Models\Ticket;

class TicketForm extends Component
{
    public $ticketId;
    public $customer_id;
    public $subject;
    public $message;
    public $status = 'processed';
    public $mode = 'edit';
    public $customers = [];

    protected $listeners = [
        'open-ticket-modal' => 'openModal'
    ];

    protected $rules = [];

    public function mount()
    {
        $this->customers = \App\Models\Customer::pluck('name', 'id')->toArray();
        $this->rules = TicketRules::manager();
    }

    public function openModal($data)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        if (isset($data['ticketId'])) {
            $ticket = Ticket::findOrFail($data['ticketId']);
            $this->ticketId = $ticket->id;
            $this->customer_id = $ticket->customer_id;
            $this->subject = $ticket->subject;
            $this->message = $ticket->message;
            $this->status = $ticket->status;
        }
        $this->dispatch('ts-dialog-open', name: 'ticket-modal');
    }

    public function save()
    {
        $this->validate();
        $data = $this->only(['customer_id', 'subject', 'message', 'status']);

        if ($this->ticketId) {
            $ticket = Ticket::findOrFail($this->ticketId);
            $ticket->update($data);
        } else {
            Ticket::create($data);
        }

        $this->dispatch('ticketUpdated');
        $this->dispatch('ts-dialog-close', name: 'ticket-modal');
        $this->dispatch('ts-notify', title: 'Ticket saved', type: 'success');
    }

    public function deleteTicket($id)
    {
        Ticket::findOrFail($id)->delete();
        $this->dispatch('ts-notify', title: 'Ticket deleted', type: 'danger');
        $this->emit('ticketUpdated');
    }

    public function render()
    {
        return view('dashboard.manager.tickets.ticket-form');
    }
}
