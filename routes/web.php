<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}) ->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::view('/services', 'admin.services')->name('services');
});

Route::middleware(['auth', 'verified', 'role:agent'])->prefix('agent')->group(function () {
    Route::get('/dashboard', [AgentController::class, 'index'])->name('agent.dashboard');
    // ... d’autres routes agent
});

Route::middleware(['auth', 'verified', 'role:client'])->prefix('client')->group(function () {
    Route::get('/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
});
