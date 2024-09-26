<?php

use App\Http\Controllers\Customer\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/ticket', [TicketController::class, 'index'])->name('ticket.index');
Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
Route::post('/ticket', [TicketController::class, 'store'])->name('ticket.store');