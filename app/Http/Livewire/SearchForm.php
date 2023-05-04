<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class SearchForm extends Component
{
    public $query;

    public $inputClasses;

    public $suggestedSearches = [];

    public $showSuggestedSearches = false;

    public $articles;

    public function clearSearch()
    {
        $this->reset('query', 'articles');
    }

    public function updatedQuery()
    {
        $this->articles = Article::query()
            ->select('title', 'slug')
            ->where('title', 'like', '%' . $this->query . '%')
            ->orWhere('content', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.search-form');
    }
}
