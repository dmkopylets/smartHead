<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'smartHead') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased"
      x-cloak
      x-data="{ name: @js(auth()->user()->name ?? 'Guest') }"
      x-on:name-updated.window="name = $event.detail.name"
      x-bind:class="{ 'dark bg-gray-800': darkTheme, 'bg-gray-100': !darkTheme }">

<x-ts-layout>
    {{-- Top slot --}}
    <x-slot:top>
        <x-ts-dialog />
        <x-ts-toast />
    </x-slot:top>

    {{-- Header --}}
    <x-slot:header>
        <x-ts-layout.header>
            <x-slot:left>
                <x-ts-theme-switch />
            </x-slot:left>

            <x-slot:right>
                <x-ts-dropdown>
                    <x-slot:action>
                        <button class="cursor-pointer" x-on:click="show = !show">
                            <span class="text-base font-semibold text-primary-500" x-text="name"></span>
                        </button>
                    </x-slot:action>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-ts-dropdown.items :text="__('Logout')" onclick="event.preventDefault(); this.closest('form').submit();" separator />
                    </form>

                </x-ts-dropdown>
            </x-slot:right>
        </x-ts-layout.header>
    </x-slot:header>

    {{-- Sidebar --}}
    <x-slot:menu>
        <x-ts-side-bar smart collapsible>
            <x-slot:brand>
                <div class="mt-8 flex items-center justify-center">
                    <img src="{{ asset('/assets/images/tsui.png') }}" width="40" height="40" alt="Logo" />
                </div>
            </x-slot:brand>

            <x-ts-side-bar.item text="Dashboard" icon="home" :route="route('manager.dashboard')" />
            <x-ts-side-bar.item text="Home Page" icon="arrow-uturn-left" :route="route('home')" />
            <x-ts-side-bar.item
                    text="Tickets"
                    icon="ticket"
                    :route="route('manager.tickets.index')"
            />
        </x-ts-side-bar>
    </x-slot:menu>

    {{-- Main content --}}
    @yield('content')
</x-ts-layout>
@if (session('error'))
    <x-ts-toast :message="session('error')" type="error" />
@endif
@livewireScripts
</body>
</html>
