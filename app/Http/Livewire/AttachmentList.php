<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AttachmentList extends Component
{
    public Model $model;
    public Media $previewMedia;
    public bool $showPreviewModal = false;

    public function preview(Media $media)
    {
        $this->showPreviewModal = true;
        $this->previewMedia = $media;
    }

    public function download(Media $media): Media
    {
        return $media;
    }

    public function render()
    {
        return view('livewire.attachment-list');
    }
}
