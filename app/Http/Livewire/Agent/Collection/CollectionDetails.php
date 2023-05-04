<?php

namespace App\Http\Livewire\Agent\Collection;

use App\Models\Article;
use App\Models\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class CollectionDetails extends Component
{
    use WithFileUploads;

    public Collection $collection;
    public $unassignedArticles = [];
    public $selectedArticles = [];
    public $browsingArticles = false;
    public $icon;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected $rules = [
        'collection.name' => 'required|string|max:255',
        'collection.description' => 'nullable|string|max:255',
        'selectedArticles' => 'required|array|min:1',
    ];

    public function updatedCollectionName()
    {
        $this->validateOnly('collection.name');
        $this->collection->save();
        $this->notify(trans('Collection\'s name has been updated.'));
    }

    public function updatedCollectionDescription($value)
    {
        $this->validateOnly('collection.description');
        empty($value) ? $this->collection->description = null : $this->collection->description = $value;
        $this->collection->save();
        $this->notify(trans('Collection\'s description has been updated.'));
    }

    public function updatedIcon()
    {
        $this->validate([
            'icon' => 'file|image|max:1024',
        ]);
        $this->collection->addMedia($this->icon->getRealPath())->toMediaCollection('icon');
        $this->collection->load('media');
        $this->reset('icon');
    }

    public function deleteCollection()
    {
        $this->collection->delete();
        $this->redirect(route('agent.collections.list'));
    }

    public function browseArticles()
    {
        $this->unassignedArticles = Article::whereNull('collection_id')->get();
        $this->selectedArticles = [];
        $this->browsingArticles = true;
    }

    public function addArticles()
    {
        $this->validate();
        Article::whereIn('id', $this->selectedArticles)->update(['collection_id' => $this->collection->id]);
        $this->reset('browsingArticles', 'selectedArticles');
        $this->emitSelf('refresh');
    }

    public function deleteArticle(Article $article)
    {
        $article->collection()->dissociate();
        $article->collection_order = null;
        $article->save();
        $this->emitSelf('refresh');
    }

    public function updateArticlesOrder($items)
    {
        foreach ($items as $item) {
            Article::find($item['value'])->update(['collection_order' => $item['order']]);
        }
        $this->collection->load('articles');
    }

    public function render()
    {
        return view('livewire.agent.collection.collection-details');
    }
}
