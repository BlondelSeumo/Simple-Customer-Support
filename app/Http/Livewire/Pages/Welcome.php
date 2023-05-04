<?php

namespace App\Http\Livewire\Pages;

use App\Models\Collection;
use Livewire\Component;

class Welcome extends Component
{
    public function getCollectionsProperty()
    {
        return Collection::with('articles')->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.pages.welcome')->layout('layouts.guest');
    }
}
