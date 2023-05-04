<?php

namespace App\Http\Livewire\User;

use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileManager extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $avatar;

    protected $listeners = ['refresh' => '$refresh'];
    
    protected function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];
    }

    public function mount()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'file|image|max:1024',
        ]);
    }

    public function removeAvatar()
    {
        if ($this->user->hasMedia('avatar')) {
            $this->user->getFirstMedia('avatar')->delete();
            $this->notify(trans('Your avatar has been removed.'));
            $this->emitSelf('refresh');
        } else {
            $this->addError('avatar', trans('You can\'t remove default avatar.'));
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->avatar) {
            $this->user->addMedia($this->avatar->getRealPath())->toMediaCollection('avatar');
            $this->reset('avatar');
        }

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $this->user->update([
                'password' => \Hash::make($this->password),
            ]);
        }

        $this->reset('password', 'password_confirmation');

        $this->emitSelf('saved');
    }

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function render()
    {
        return view('livewire.user.profile-manager')->layout('layouts.guest');
    }
}
