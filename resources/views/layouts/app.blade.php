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
    {{-- Livewire & Vite --}}
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
   @include('layouts.header')

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main content --}}
    @yield('content')
</x-ts-layout>
@if (session('error'))
    <x-ts-toast :message="session('error')" type="error" />
@endif
@livewireScripts
</body>
</html>
