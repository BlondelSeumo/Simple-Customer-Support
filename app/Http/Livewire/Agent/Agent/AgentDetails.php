<?php

namespace App\Http\Livewire\Agent\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;

class AgentDetails extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public Agent $agent;
    public $name;
    public $email;
    public $password;
    public $avatar;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->authorize('view', $this->agent);

        $this->agent->load(['assignedTickets' => function ($query) {
            $query->limit(5)->latest();
        }]);
    }

    public function updateAgentName()
    {
        $this->validate([
            'name' => ['present', 'required', 'string', 'max:255'],
        ]);
        $this->agent->name = $this->name;
        $this->agent->save();
        $this->dispatchBrowserEvent('agent-name-updated');
        $this->notify(trans('Agent name updated.'));
    }

    public function updateAgentEmail()
    {
        $this->validate([
            'email' => ['present', 'required', 'string', 'email', 'max:255', 'unique:agents,email'],
        ]);
        $this->agent->email = $this->email;
        $this->agent->save();
        $this->dispatchBrowserEvent('agent-email-updated');
        $this->notify(trans('Agent email updated.'));
    }

    public function updateAgentPassword()
    {
        $this->validate([
            'password' => ['present', 'required', Rules\Password::defaults()],
        ]);
        $this->agent->password = \Hash::make($this->password);
        $this->agent->save();
        $this->dispatchBrowserEvent('agent-password-updated');
        $this->notify(trans('Agent password updated.'));
    }

    public function updateAgentAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
        $this->agent->addMedia($this->avatar->getRealPath())->toMediaCollection('avatar');
        $this->agent->load('media');
        $this->reset('avatar');
        $this->notify(trans('Agent avatar updated.'));
    }

    public function removeAgentAvatar()
    {
        $this->agent->getFirstMedia('avatar')->delete();
        $this->agent->load('media');
        $this->notify(trans('Agent avatar removed.'));
    }

    public function toggleAdminRole()
    {
        $this->authorize('toggleAdminRole', $this->agent);
        $this->agent->is_admin = ! $this->agent->is_admin;
        $this->agent->save();
    }

    public function banAgent()
    {
        $this->agent->ban();
        $this->emitSelf('refresh');
    }

    public function unbanAgent()
    {
        $this->agent->unban();
        $this->emitSelf('refresh');
    }

    public function getAssignedTicketsProperty()
    {
        return $this->agent->assignedTickets()->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.agent.agent.agent-details');
    }
}
