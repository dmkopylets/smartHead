<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('dashboard_route')) {
    function dashboard_route(): string
    {
        $user = auth()->user();

        if (! $user) {
            return Route::has('login') ? route('login') : '/';
        }

        if ($user->hasRole('admin') && Route::has('admin.dashboard')) {
            return route('admin.dashboard');
        }

        if ($user->hasRole('manager') && Route::has('manager.dashboard')) {
            return route('manager.dashboard');
        }

        return Route::has('home') ? route('home') : '/';
    }
}

