<?php

namespace App\Http\Livewire;

use App\Enums\TicketStatus;
use App\Events\CommentCreated;
use App\Models\Agent;
use App\Models\Comment;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

class TicketCommentForm extends Component
{
    use WithFileUploads;

    public Ticket $ticket;

    public Comment $comment;

    public $image;

    public $attachments = [];

    protected function rules()
    {
        return [
            'comment.content' => [
                'required',
                'string',
            ],
            'comment.is_private' => [
                'boolean',
            ],
            'attachments.*' => [
                'file',
                'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,zip',
                'max:' . ($this->ticketSettings->max_attachment_upload_size * 1024),
            ],
        ];
    }

    protected function messages()
    {
        return [
            'attachments.*.mimes' => 'Attachment #:position is not a valid file type.',
            'attachments.*.max' => 'Attachment #:position is too large.',
        ];
    }

    protected function makeBlankComment(): Comment
    {
        return new Comment([
            'is_private' => false,
        ]);
    }

    public function mount()
    {
        $this->comment = $this->makeBlankComment();

        if ($this->user instanceof Agent) {
            $this->user->load('cannedResponses');
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:' . ($this->ticketSettings->max_image_upload_size * 1024),
        ]);

        $image = $this->ticket->addMedia($this->image->getRealPath())
            ->usingName($this->image->getClientOriginalName())
            ->usingFileName($this->image->getClientOriginalName())
            ->toMediaCollection('comments-media');

        $this->dispatchBrowserEvent('tiptap-insert-image', ['name' => $image->name, 'url' => $image->original_url]);
    }

    public function updatedAttachments()
    {
        $this->validate([
            'attachments.*' => 'file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,zip|max:' . ($this->ticketSettings->max_attachment_upload_size * 1024),
        ], [
            'attachments.*.mimes' => 'Attachment #:position is not a valid file type.',
            'attachments.*.max' => 'Attachment #:position is too large.',
        ]);
    }

    public function removeAttachment($index)
    {
        array_splice($this->attachments, $index, 1);
    }

    public function submit()
    {
        $this->validate();
        if ($this->ticket->status->value === TicketStatus::CLOSED->value) {
            return $this->addError('comment.content', trans('You can\'t comment on this ticket because it has been closed.'));
        }
        $this->comment->commentator()->associate($this->user);
        $this->comment->commentable()->associate($this->ticket);
        $this->comment->save();
        foreach ($this->attachments as $attachment) {
            $this->comment
                ->addMedia($attachment->getRealPath())
                ->usingName($attachment->getClientOriginalName())
                ->usingFileName($attachment->getClientOriginalName())
                ->toMediaCollection('attachments');
        }
        CommentCreated::dispatch($this->comment);
        $this->comment = $this->makeBlankComment();
        $this->reset('attachments');
        $this->emitTo('ticket-comment-list', 'commentSubmitted');
        $this->dispatchBrowserEvent('comment-submitted');
    }

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function getTicketSettingsProperty()
    {
        return app(\App\Settings\TicketSettings::class);
    }

    public function render()
    {
        return view('livewire.ticket-comment-form');
    }
}
