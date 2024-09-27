<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/ticket', [TicketController::class, 'index'])->name('admin.ticket.index');
Route::get('/ticket/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
Route::post('/ticket', [TicketController::class, 'update'])->name('admin.ticket.update');