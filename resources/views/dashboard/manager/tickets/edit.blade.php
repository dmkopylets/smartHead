@extends('dashboard.manager.layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Editing Ticket #{{ $ticket->id }}
            </h2>
        </div>

        <form method="POST" action="{{ route('manager.tickets.update', $ticket) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Customer --}}
            <div>
                <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Customer
                </label>
                <select id="customer_id" name="customer_id"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($customers as $id => $name)
                        <option value="{{ $id }}" @selected($id == $ticket->customer_id)>{{ $name }}</option>
                    @endforeach
                </select>
                @error('customer_id')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Subject
                </label>
                <input id="subject" name="subject" type="text"
                       value="{{ old('subject', $ticket->subject) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('subject')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Message
                </label>
                <textarea id="message" name="message" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('message', $ticket->message) }}</textarea>
                @error('message')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Status
                </label>
                <select id="status" name="status"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="new" @selected($ticket->status === 'new')>New</option>
                    <option value="in_progress" @selected($ticket->status === 'in_progress')>In Progress</option>
                    <option value="processed" @selected($ticket->status === 'processed')>Processed</option>
                </select>
                @error('status')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <a href="{{ route('manager.tickets.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
