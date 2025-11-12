@extends('dashboard.manager.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-xl">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Tickets Management
            </h1>
        </div>

        <div class="overflow-x-auto w-full">
            <livewire:manager.tickets-table />
        </div>

        <x-ts-dialog name="ticket-modal">
            <livewire:dashboard.manager.tickets.ticket-form />
        </x-ts-dialog>
    </div>
@endsection
