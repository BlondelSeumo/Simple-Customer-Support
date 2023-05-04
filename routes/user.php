<?php

use App\Http\Livewire\User\ProfileManager;
use App\Http\Livewire\User\Ticket\TicketCreator;
use App\Http\Livewire\User\Ticket\TicketDetails;
use App\Http\Livewire\User\Ticket\TicketList;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'prevent-banned-user'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('profile', ProfileManager::class)->name('profile');
    Route::get('tickets', TicketList::class)->name('tickets.list');
    Route::get('tickets/create', TicketCreator::class)->name('tickets.create');
    Route::get('tickets/{ticket}', TicketDetails::class)->name('tickets.details');
});
