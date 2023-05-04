<?php

namespace App\Http\Livewire\Pages;

use App\Models\Collection;
use Livewire\Component;

class CollectionList extends Component
{
    public function getCollectionsProperty()
    {
        return Collection::query()
            ->whereHas('articles')
            ->with([
                'media',
                'authors',
                'authors.media',
            ])
            ->withCount('articles')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.collection-list')->layout('layouts.guest');
    }
}
