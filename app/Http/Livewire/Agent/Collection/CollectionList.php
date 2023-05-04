<?php

namespace App\Http\Livewire\Agent\Collection;

use App\Models\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class CollectionList extends Component
{
    use WithPagination;

    public $collection;
    public $showCollectionForm = false;

    protected $rules = [
        'collection.name' => 'required|string|max:255',
        'collection.description' => 'nullable|string|max:255',
    ];

    public function createCollection()
    {
        $this->collection = new Collection();
        $this->resetErrorBag();
        $this->showCollectionForm = true;
    }

    public function saveCollection()
    {
        $this->validate();
        $this->collection->save();
        $this->dispatchBrowserEvent('notify', trans('Collection has been created.'));
        $this->reset('collection', 'showCollectionForm');
    }

    public function updateCollectionsOrder($items)
    {
        foreach ($items as $item) {
            Collection::find($item['value'])->update(['order' => $item['order']]);
        }
    }

    public function getCollectionsProperty()
    {
        return Collection::query()
            ->with('media')
            ->withCount('articles')
            ->orderBy('order')
            ->get();
    }

    public function render()
    {
        return view('livewire.agent.collection.collection-list');
    }
}
