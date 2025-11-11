@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center">Log in</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <x-ts-input
                    name="email"
                    label="Email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
            />

            <x-ts-password
                    name="password"
                    label="Password"
                    required
            />

            <div class="flex items-center justify-between mt-4">
                <x-ts-checkbox name="remember" label="Remember me" />
                <x-ts-button
                        type="submit"
                        icon="arrow-left-end-on-rectangle"
                        color="primary"
                        label="Log in"
                />
            </div>

            @error('email')
            <x-ts-alert icon="exclamation-triangle" color="danger" title="Error" text="{{ $message }}" />
            @enderror
        </form>

        <p class="text-center mt-4 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        </p>
    </div>
@endsection
