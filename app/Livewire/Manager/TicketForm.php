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
    public $status = 'new';
    public $mode = 'create';

    protected $listeners = [
        'open-ticket-modal' => 'openModal'
    ];

    protected $rules = [
        'customer_id' => 'required|exists:users,id',
        'subject' => 'required|string|max:255',
        'message' => 'nullable|string',
        'status' => 'required|in:new, in_progress, processed',
    ];

    public function open($data)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->mode = $data['mode'];

        if ($this->mode === 'edit' && isset($data['ticketId'])) {
            $ticket = Ticket::findOrFail($data['ticketId']);
            $this->ticketId = $ticket->id;
            $this->customer_id = $ticket->customer_id;
            $this->subject = $ticket->subject;
            $this->message = $ticket->message;
            $this->status = $ticket->status;
        } else {
            $this->reset(['ticketId', 'customer_id', 'subject', 'message', 'status']);
            $this->status = 'new';
        }
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

    public function render()
    {
        return view('livewire.manager.ticket-form');
    }
}
