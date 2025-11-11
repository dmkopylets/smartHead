<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackWidgetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'welcome')->name('home');
Route::get('/feedback-widget', [FeedbackWidgetController::class, 'index'])
    ->name('feedback.widget');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:manager'])
    ->prefix('manager')
    ->name('manager.')
    ->group(function () {
        Route::get('/', fn () => view('dashboard.manager.index'))->name('dashboard');
        Route::get('/tickets', fn () => view('dashboard.manager.tickets'))->name('tickets');
    });
