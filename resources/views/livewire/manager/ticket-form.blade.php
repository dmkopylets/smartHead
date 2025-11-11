<div class="space-y-4 p-4 w-full max-w-lg">
    <h2 class="text-lg font-semibold">{{ $mode === 'create' ? 'Create Ticket' : 'Edit Ticket' }}</h2>

    <form wire:submit.prevent="save" class="space-y-4">
        <x-ts-input label="Status" type="select" wire:model.defer="customer_id">
            <option value={{$customer_id}} >"$customers->pluck('name', 'id')"</option>
        </x-ts-input>

        <x-ts-input
                label="Subject"
                wire:model.defer="subject"
                placeholder="Ticket subject"
        />

        <x-ts-textarea
                label="Message"
                wire:model.defer="message"
                placeholder="Ticket message"
        />

        <x-ts-input label="Status" type="select" wire:model="status">
            <option value='new'>New</option>
            <option value='in_progress'>in Progress</option>
            <option value='processed'>Processed</option>
        </x-ts-input>

        <div class="flex justify-end space-x-2">
            <x-ts-button
                    color="secondary"
                    label="Cancel"
                    x-on:click="$dispatch('ts-dialog:close', { name: 'ticket-modal' })"
            />
            <x-ts-button
                    type="submit"
                    color="primary"
                    label="{{ $mode === 'create' ? 'Create' : 'Save' }}"
            />
        </div>
    </form>
</div>
