@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-semibold mb-4">Manager panel</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <x-ts-button
                color="danger"
                icon="arrow-right-on-rectangle"
                label="Logout"
                type="submit" />
        </form>
    </div>
@endsection
