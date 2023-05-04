<?php

namespace App\Http\Livewire\Agent\Agent;

use App\Models\Agent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class AgentCreator extends Component
{
    use AuthorizesRequests;

    public Agent $agent;
    public $name;
    public $email;
    public $is_admin = false;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:agents,email',
            'is_admin' => 'nullable|boolean',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function mount()
    {
        $this->authorize('create', Agent::class);

        $this->agent = new Agent();
    }

    public function save()
    {
        $this->validate();
        $this->agent->fill([
            'name' => $this->name,
            'email' => $this->email,
            'is_admin' => $this->is_admin,
            'password' => Hash::make($this->password),
        ]);
        $this->agent->save();
        $this->redirect(route('agent.agents.details', $this->agent));
    }

    public function render()
    {
        return view('livewire.agent.agent.agent-creator');
    }
}
