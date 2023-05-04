<?php

namespace App\Http\Livewire\Agent;

use App\Http\Livewire\Traits\WithBulkActions;
use Illuminate\Notifications\DatabaseNotification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationManager extends Component
{
    use WithBulkActions;
    use WithPagination;

    public bool $isUnRead = false;
    
    protected $queryString = [
        'isUnRead' => ['except' => false, 'as' => 'unread'],
    ];

    public function updatedIsUnRead()
    {
        $this->resetPage();
    }

    public function updatedPage()
    {
        $this->clearSelection();
    }

    public function markNotificationAsRead(DatabaseNotification $notification)
    {
        $notification->markAsRead();
    }

    public function markSelectedNotificationAsRead()
    {
        auth()->user()->notifications()->whereIn('id', $this->selected)->update(['read_at' => now()]);
        if ($this->isUnRead) $this->clearSelection();
    }

    public function markNotificationAsUnRead(DatabaseNotification $notification)
    {
        $notification->markAsUnread();
    }

    public function markSelectedNotificationAsUnRead()
    {
        auth()->user()->notifications()->whereIn('id', $this->selected)->update(['read_at' => null]);
    }

    public function deleteNotification(DatabaseNotification $notification)
    {
        $notification->delete();
    }

    public function deleteSelectedNotification()
    {
        auth()->user()->notifications()->whereIn('id', $this->selected)->delete();
        $this->clearSelection();
    }

    public function getRowsQueryProperty()
    {
        return $this->isUnRead ? auth()->user()->unreadNotifications() : auth()->user()->notifications();
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.notification-manager', [
            'notifications' => $this->rows,
        ]);
    }
}
