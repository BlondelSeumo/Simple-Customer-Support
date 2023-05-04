<?php

namespace App\Http\Livewire\Agent\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralForm extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $about;
    public $avatar;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'about' => 'nullable|string',
    ];

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->name = $this->agent->name;
        $this->email = $this->agent->email;
        $this->about = $this->agent->about;
    }

    public function getAgentProperty()
    {
        return \Auth::user();
    }

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'file|image|max:1024',
        ]);
    }

    public function removeAvatar()
    {
        if ($this->agent->hasMedia('avatar')) {
            $this->agent->getFirstMedia('avatar')->delete();
            $this->notify(trans('Your avatar has been removed.'));
            $this->emitSelf('refresh');
        } else {
            $this->addError('avatar', trans('You can\'t remove default avatar.'));
        }
    }

    public function submit()
    {
        $this->validate();
        if ($this->avatar) {
            $this->agent->addMedia($this->avatar->getRealPath())->toMediaCollection('avatar');
            $this->reset('avatar');
        }
        $this->agent->name = $this->name;
        $this->agent->email = $this->email;
        $this->agent->about = $this->about;
        $this->agent->save();
        $this->notify(trans('Profile successfully updated.'));
    }

    public function render()
    {
        return view('livewire.agent.profile.general-form');
    }
}
