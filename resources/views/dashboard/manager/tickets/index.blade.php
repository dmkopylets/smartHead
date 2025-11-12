@extends('dashboard.manager.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-xl">

        @if (session('success'))
            <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-transition
                    class="mb-6 flex items-center justify-between p-4 rounded-md bg-green-100 text-green-800 border border-green-300"
                    >
                    <span>{{ session('success') }}</span>
                    <button type="button" x-on:click="show = false" class="text-green-600 hover:text-green-900">
                        &times;
                    </button>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Tickets Management
            </h1>
        </div>

        <div class="overflow-x-auto w-full">
            <livewire:manager.tickets-table />
        </div>

    </div>
@endsection
