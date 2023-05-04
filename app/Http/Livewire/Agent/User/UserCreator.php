<?php

namespace App\Http\Livewire\Agent\User;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserCreator extends Component
{
    use AuthorizesRequests;

    public User $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function mount()
    {
        $this->authorize('create', User::class);
        
        $this->user = new User();
    }

    public function save()
    {
        $this->validate();
        $this->user->fill([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $this->user->save();
        $this->redirect(route('agent.users.details', $this->user));
    }

    public function render()
    {
        return view('livewire.agent.user.user-creator');
    }
}
