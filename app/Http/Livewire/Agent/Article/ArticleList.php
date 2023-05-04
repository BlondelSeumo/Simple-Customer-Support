<?php

namespace App\Http\Livewire\Agent\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createArticle()
    {
        $article = new Article();

        $article->author()->associate(auth()->user());

        $article->title = trans('Untitled article');

        $article->save();

        $this->redirect(route('agent.articles.details', $article));
    }

    public function getArticlesProperty()
    {
        return Article::query()
            ->with('collection')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.article.article-list');
    }
}
