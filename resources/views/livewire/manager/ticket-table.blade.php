<div>
    <div class="flex justify-end mb-4">
        <x-ts-button
                icon="plus-circle"
                color="primary"
                label="Create Ticket"
                x-on:click="$dispatch('open-ticket-modal', { mode: 'create' })" />
    </div>

    <x-ts-table>
        <x-slot:head>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </x-slot:head>

        <x-slot:body>
            @forelse($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->customer_id }}</td>
                    <td>{{ $ticket->subject }}</td>
                    <td>
                        <x-ts-badge
                                :color="$ticket->status === 'new' ? 'success' : ($ticket->status === 'in_process' ? 'warning' : 'secondary')"
                                :label="$ticket->status"
                        />
                    </td>
                    <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                    <td class="space-x-2">
                        <x-ts-button
                                size="sm"
                                color="secondary"
                                icon="pencil-square"
                                x-on:click="$dispatch('open-ticket-modal', { mode: 'edit', ticketId: {{ $ticket->id }} })" />
                        <x-ts-button
                                size="sm"
                                color="danger"
                                icon="trash"
                                wire:click="delete({{ $ticket->id }})" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">No tickets found.</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-ts-table>
</div>
