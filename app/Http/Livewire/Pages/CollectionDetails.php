<?php

namespace App\Http\Livewire\Pages;

use App\Models\Collection;
use Livewire\Component;

class CollectionDetails extends Component
{
    public Collection $collection;

    public function mount()
    {
        $this->collection->load('articles.author.media');
    }

    public function render()
    {
        return view('livewire.pages.collection-details')->layout('layouts.guest');
    }
}
