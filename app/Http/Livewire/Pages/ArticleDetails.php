<?php

namespace App\Http\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;

class ArticleDetails extends Component
{
    public Article $article;

    public function mount()
    {
        $this->article->load('collection', 'author.media');
    }

    public function render()
    {
        return view('livewire.pages.article-details')->layout('layouts.guest');
    }
}
