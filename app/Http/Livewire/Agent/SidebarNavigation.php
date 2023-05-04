<?php

namespace App\Http\Livewire\Agent;

use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Settings\GeneralSettings;
use Livewire\Component;

class SidebarNavigation extends Component
{
    public $host;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->host = request()->getHost();
    }

    public function getAssignedOpenTicketsCountProperty()
    {
        return Ticket::query()
            ->where('status', TicketStatus::OPEN)
            ->whereHas('assignees', function ($query) {
                $query->where('agent_id', auth()->id());
            })->count();
    }

    public function getTotalOpenTicketsCountProperty()
    {
        return Ticket::query()
            ->where('status', TicketStatus::OPEN)
            ->count();
    }

    public function getIsLicenseActivatedProperty(): bool
    {
        return app(GeneralSettings::class)->purchase_code;
    }

    public function getIsLocalProperty(): bool
    {
        return $this->host == 'localhost' || $this->host == '127.0.0.1' || \Str::endsWith($this->host, ['.test', '.example', '.invalid', '.local', '.localhost']);
    }

    public function getIsStagingProperty(): bool
    {
        return \Str::startsWith($this->host, ['dev.', 'demo.', 'test.', 'testing.', 'stage.', 'staging.', 'development.']);
    }

    public function render()
    {
        return view('livewire.agent.sidebar-navigation');
    }
}
