<?php

namespace App\Http\Livewire\Agent\Article;

use App\Models\Article;
use App\Models\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArticleDetails extends Component
{
    use WithFileUploads;

    public Article $article;
    public $showSettings = false;
    public $showMediaModal = false;
    public $mediaFile;
    public $selectedMedia;
    public $maxUploadSize = 100000; // 100MB

    protected function rules()
    {
        return [
            'article.collection_id' => ['nullable', 'exists:collections,id'],
            'article.title' => ['required', 'string', 'max:255'],
            'article.slug' => ['required', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($this->article->id)],
            'article.excerpt' => ['nullable', 'string', 'max:255'],
            'article.content' => ['required', 'string'],
            'article.seo_title' => ['nullable', 'string'],
            'article.seo_description' => ['nullable', 'string'],
        ];
    }

    public function mount()
    {
        $this->article->load('media');
    }

    public function updatedArticleTitle($value)
    {
        $this->article->title = empty($value) ? trans('Untitled article') : trim($value);
    }

    public function updatedArticleSlug($value)
    {
        $this->article->slug = empty($value) ? \Str::slug($this->article->title) : \Str::slug($value);
    }

    public function generateSlug()
    {
        $this->article->slug = \Str::slug($this->article->title);
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updatedMediaFile()
    {
        $mimeType = $this->mediaFile->getMimeType();

        if (str_contains($mimeType, 'image')) {
            $this->validate([
                'mediaFile' => 'required|image|max:' . $this->maxUploadSize,
            ]);
        } elseif (str_contains($mimeType, 'video')) {
            $this->validate([
                'mediaFile' => 'required|mimetypes:video/mp4,video/quicktime|max:' . $this->maxUploadSize,
            ]);
        } else {
            $this->reset('mediaFile');

            $this->addError('mediaFile', 'Invalid file type. Please upload an image or video file.');

            return;
        }

        $this->uploadMedia();
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function uploadMedia()
    {
        $this->article
            ->addMedia($this->mediaFile->getRealPath())
            ->usingName($this->mediaFile->getClientOriginalName())
            ->usingFileName($this->mediaFile->hashName())
            ->toMediaCollection(str_contains($this->mediaFile->getMimeType(), 'image') ? 'images' : 'videos');

        $this->article->load('media');

        $this->reset('mediaFile');
    }

    public function insertMedia(Media $media)
    {
        if (str_contains($media->mime_type, 'image')) {
            $this->dispatchBrowserEvent('tiptap-insert-image', ['name' => $media->name, 'url' => $media->getFullUrl()]);
        }

        if (str_contains($media->mime_type, 'video')) {
            $this->dispatchBrowserEvent('tiptap-insert-video', ['url' => $media->getUrl()]);
        }

        $this->showMediaModal = false;
    }

    public function deleteMedia(Media $media)
    {
        $media->delete();

        $this->article->load('media');
    }

    public function save()
    {
        $this->validate();

        $this->article->save();

        $this->notify(trans('Article has been updated.'));
    }

    public function delete()
    {
        $this->article->delete();

        $this->redirect(route('agent.articles.list'));
    }

    public function getCollectionsProperty(): \Illuminate\Database\Eloquent\Collection
    {
        return Collection::all();
    }

    public function getMediaProperty()
    {
        return $this->article->media;
    }

    public function render()
    {
        return view('livewire.agent.article.article-details');
    }
}
