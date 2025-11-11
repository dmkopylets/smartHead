@extends('dashboard.manager.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Tickets Management
            </h1>

            <x-ts-button
                    icon="plus-circle"
                    color="primary"
                    label="Create Ticket"
                    x-on:click="$dispatch('open-ticket-modal', { mode: 'create' })" />
        </div>

        <livewire:manager.tickets-table />

        <form method="POST" action="{{ route('logout') }}" class="mt-8 text-right">
            @csrf
            <x-ts-button color="danger" icon="arrow-right-on-rectangle" label="Logout" type="submit" />
        </form>
    </div>

    <x-ts-dialog name="ticket-modal">
        <livewire:manager.ticket-form />
    </x-ts-dialog>
@endsection
