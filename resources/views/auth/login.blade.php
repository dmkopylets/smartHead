@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center">Увійти</h2>

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
                label="Пароль"
                required
            />

            <div class="flex items-center justify-between mt-4">
                <x-ts-checkbox name="remember" label="Запам'ятати мене" />
                <x-ts-button
                    type="submit"
                    icon="login"
                    color="primary"
                    label="Увійти"
                />
            </div>

            @error('email')
            <x-ts-alert icon="exclamation-triangle" color="danger" title="Помилка" text="{{ $message }}" />
            @enderror
        </form>

        <p class="text-center mt-4 text-sm">
            Немає акаунта?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Зареєструватися</a>
        </p>
    </div>
@endsection
