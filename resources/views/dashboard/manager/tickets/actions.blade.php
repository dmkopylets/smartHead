<div class="flex space-x-2">

    <a href="{{ route('manager.tickets.edit', $ticket->id) }}"
       class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
        Edit
    </a>

    <button
        type="button"
        wire:click="delete({{ $ticket->id }})"
        onclick="confirm('Are you sure you want to delete this ticket?') || event.stopImmediatePropagation()"
        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
    >
        <x-heroicon-o-trash class="w-4 h-4 mr-1" />
        Delete
    </button>
</div>
