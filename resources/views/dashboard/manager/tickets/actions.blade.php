<div class="flex space-x-2">
    <x-ts-button
        size="sm"
        color="secondary"
        icon="pencil-square"
        x-on:click="$dispatch('open-ticket-modal', { mode: 'edit', ticketId: {{ $ticket->id }} })"
    />

    <x-ts-button
        size="sm"
        color="danger"
        icon="trash"
        wire:click="$emit('deleteTicket', {{ $ticket->id }})"
    />
</div>
