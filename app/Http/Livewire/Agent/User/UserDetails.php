<?php

namespace App\Http\Livewire\Agent\User;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Livewire\WithFileUploads;

class UserDetails extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public User $user;
    public $name;
    public $email;
    public $password;
    public $avatar;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->authorize('view', $this->user);
    }

    public function updateUserName()
    {
        $this->validate([
            'name' => ['present', 'required', 'string', 'max:255'],
        ]);
        $this->user->name = $this->name;
        $this->user->save();
        $this->dispatchBrowserEvent('user-name-updated');
        $this->notify(trans('User name updated.'));
    }

    public function updateUserEmail()
    {
        $this->validate([
            'email' => ['present', 'required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);
        $this->user->email = $this->email;
        $this->user->save();
        $this->dispatchBrowserEvent('user-email-updated');
        $this->notify(trans('User email updated.'));
    }

    public function updateUserPassword()
    {
        $this->validate([
            'password' => ['present', 'required', Rules\Password::defaults()],
        ]);
        $this->user->password = \Hash::make($this->password);
        $this->user->save();
        $this->dispatchBrowserEvent('user-password-updated');
        $this->notify(trans('User password updated.'));
    }

    public function updateUserPhoto()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
        $this->user->addMedia($this->avatar->getRealPath())->toMediaCollection('avatar');
        $this->user->load('media');
        $this->reset('avatar');
        $this->notify(trans('User avatar updated.'));
    }

    public function removeUserPhoto()
    {
        $this->user->getFirstMedia('avatar')->delete();
        $this->user->load('media');
        $this->notify(trans('User avatar removed.'));
    }

    public function banUser()
    {
        $this->user->ban();
        $this->emitSelf('refresh');
    }

    public function unbanUser()
    {
        $this->user->unban();
        $this->emitSelf('refresh');
    }

    public function getSubmittedTicketsProperty()
    {
        return $this->user->tickets()->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.agent.user.user-details');
    }
}
