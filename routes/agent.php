<?php

use App\Http\Livewire\Agent\Agent\AgentCreator;
use App\Http\Livewire\Agent\Agent\AgentDetails;
use App\Http\Livewire\Agent\Agent\AgentList;
use App\Http\Livewire\Agent\Article\ArticleDetails;
use App\Http\Livewire\Agent\Article\ArticleList;
use App\Http\Livewire\Agent\Auth\ForgotPassword;
use App\Http\Livewire\Agent\Auth\Login;
use App\Http\Livewire\Agent\Auth\Register;
use App\Http\Livewire\Agent\Auth\ResetPassword;
use App\Http\Livewire\Agent\CannedResponseManager;
use App\Http\Livewire\Agent\CategoryManager;
use App\Http\Livewire\Agent\Collection\CollectionDetails;
use App\Http\Livewire\Agent\Collection\CollectionList;
use App\Http\Livewire\Agent\Dashboard;
use App\Http\Livewire\Agent\LabelManager;
use App\Http\Livewire\Agent\NotificationManager;
use App\Http\Livewire\Agent\ProductManager;
use App\Http\Livewire\Agent\Profile\ProfileManager;
use App\Http\Livewire\Agent\Setting\EnvatoSettingsManager;
use App\Http\Livewire\Agent\Setting\GeneralSettingsManager;
use App\Http\Livewire\Agent\Setting\LayoutSettingsManager;
use App\Http\Livewire\Agent\Setting\LicenseManager;
use App\Http\Livewire\Agent\Setting\NotificationSettingsManager;
use App\Http\Livewire\Agent\Setting\TicketSettingsManager;
use App\Http\Livewire\Agent\Ticket\TicketDetails;
use App\Http\Livewire\Agent\Ticket\TicketEdit;
use App\Http\Livewire\Agent\Ticket\TicketList;
use App\Http\Livewire\Agent\User\UserCreator;
use App\Http\Livewire\Agent\User\UserDetails;
use App\Http\Livewire\Agent\User\UserList;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'agent', 'as' => 'agent.'], function () {
    Route::group(['middleware' => 'guest:agent'], function () {
        Route::get('login', Login::class)->name('login');
        // Route::get('register', Register::class)->name('register');
        Route::get('forgot-password', ForgotPassword::class)->name('forgot-password');
        Route::get('reset-password/{token}', ResetPassword::class)->name('reset-password');
    });

    Route::group(['middleware' => ['auth:agent', 'prevent-banned-user']], function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('profile', ProfileManager::class)->name('profile');
        Route::get('notifications', NotificationManager::class)->name('notifications');
        Route::get('canned-responses', CannedResponseManager::class)->name('canned-responses');
        Route::get('settings/general', GeneralSettingsManager::class)->name('settings.general');
        Route::get('settings/layout', LayoutSettingsManager::class)->name('settings.layout');
        Route::get('settings/ticket', TicketSettingsManager::class)->name('settings.ticket');
        Route::get('settings/notification', NotificationSettingsManager::class)->name('settings.notification');
        Route::get('settings/envato', EnvatoSettingsManager::class)->name('settings.envato');
        Route::get('settings/license', LicenseManager::class)->name('settings.license');
        Route::get('tickets', TicketList::class)->name('tickets.list');
        Route::get('tickets/{ticket}', TicketDetails::class)->name('tickets.details');
        Route::get('tickets/{ticket}/edit', TicketEdit::class)->name('tickets.edit');
        Route::get('collections', CollectionList::class)->name('collections.list');
        Route::get('collections/{collection}', CollectionDetails::class)->name('collections.details');
        Route::get('articles', ArticleList::class)->name('articles.list');
        Route::get('articles/{article}', ArticleDetails::class)->name('articles.details');
        Route::get('users', UserList::class)->name('users.list');
        Route::get('users/create', UserCreator::class)->name('users.create');
        Route::get('users/{user}', UserDetails::class)->name('users.details');
        Route::get('agents', AgentList::class)->name('agents.list');
        Route::get('agents/create', AgentCreator::class)->name('agents.create');
        Route::get('agents/{agent}', AgentDetails::class)->name('agents.details');
        Route::get('labels', LabelManager::class)->name('labels');
        Route::get('products', ProductManager::class)->name('products');
        Route::get('categories', CategoryManager::class)->name('categories');
    });
});
