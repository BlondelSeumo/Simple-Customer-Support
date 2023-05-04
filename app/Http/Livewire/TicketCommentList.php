<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use App\Settings\TicketSettings;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class TicketCommentList extends Component
{
    use WithPagination;

    public Ticket $ticket;

    public $search = '';

    public $perPage = 10;

    public $sortDirection = 'desc';

    public $commentVisibility = 'all';

    protected $paginationTheme = 'centered-tailwind';

    protected $queryString = ['sortDirection' => ['except' => 'desc', 'as' => 'commentsDirection']];

    protected $listeners = ['changeSortDirection', 'commentSubmitted'];

    protected $rules = [
        'search' => 'nullable|string',
        'perPage' => 'required|integer|min:1|max:100',
        'sortDirection' => 'required|in:asc,desc',
        'commentVisibility' => 'required|in:all,public,private',
    ];

    public function mount()
    {
        $this->perPage = $this->ticketSettings->max_comments_per_page;
    }

    public function applyFilters() {}

    public function resetFilters()
    {
        $this->reset('search', 'perPage', 'sortDirection', 'commentVisibility');
    }

    public function commentSubmitted()
    {
        $this->getCommentsProperty();

        if ($this->sortDirection == 'asc' && $this->comments->currentPage() !== $this->comments->lastPage()) {
            $this->redirect(route('agent.tickets.details', ['ticket' => $this->ticket, 'commentsPage' => $this->comments->lastPage(), 'commentsDirection' => 'asc']));
        }
    }

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function getCommentsProperty()
    {
        return Comment::query()
            ->with(['media', 'commentator.media'])
            ->whereHasMorph('commentable', Ticket::class, function (Builder $query) {
                $query->where('id', $this->ticket->id);
            })
            ->when($this->commentVisibility == 'public' || $this->user instanceof User, function (Builder $query) {
                return $query->where('is_private', false);
            })
            ->when($this->commentVisibility == 'private', function (Builder $query) {
                return $query->where('is_private', true);
            })
            ->when($this->search, function (Builder $query) {
                return $query->where('content', 'like', "%{$this->search}%");
            })
            ->orderBy('created_at', $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'commentsPage');
    }

    public function getPerPageOptionsProperty()
    {
        $defaultOptions = [10, 25, 50, 100];

        $defaultOptions[] = $this->ticketSettings->max_comments_per_page;

        sort($defaultOptions);

        return array_unique($defaultOptions, SORT_ASC);
    }

    public function getTicketSettingsProperty()
    {
        return app(TicketSettings::class);
    }

    public function render()
    {
        return view('livewire.ticket-comment-list');
    }
}
