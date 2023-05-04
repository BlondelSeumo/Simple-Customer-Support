<?php

namespace App\Http\Livewire\Agent\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class AgentList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->authorize('viewAny', Agent::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getAgentsProperty()
    {
        return Agent::query()
            ->with('media')
            ->withCount('assignedTickets')
            ->when($this->search, function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.agent.agent-list');
    }
}
