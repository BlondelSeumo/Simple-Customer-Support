<?php

namespace App\Http\Livewire\Agent\Ticket;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketList extends Component
{
    use WithPagination;
    use WithSorting;

    public $search;
    public $status;
    public $label;
    public $author;
    public $assignee;
    public $priority;
    public $product;
    public $category;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'label',
        'author',
        'assignee',
        'priority',
        'product',
        'category',
        'sorts',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingPriority()
    {
        $this->resetPage();
    }

    public function updatingProduct()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingLabel()
    {
        $this->resetPage();
    }

    public function getRowsQueryProperty()
    {
        $query = Ticket::query()
            ->with('category', 'user', 'assignees.media')
            ->when(! auth()->user()->is_admin, function ($query) {
                $query
                    ->whereHas('assignees', function ($query) {
                        $query->where('agent_id', auth()->id());
                    })
                    ->orWhereHas('product.managers', function ($query) {
                        $query->where('agent_id', auth()->id());
                    });
            })
            ->when(! $this->sorts, function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->when($this->search, function ($query) {
                $query->where('subject', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->priority, function ($query) {
                $query->where('priority', $this->priority);
            })
            ->when($this->product, function ($query) {
                $query->where('product_id', $this->product);
            })
            ->when($this->category, function ($query) {
                $query->whereHas('category', function ($q) {
                    $q->where('slug', $this->category);
                });
            })
            ->when($this->author, function ($query) {
                $query->where('user_id', $this->author);
            })
            ->when($this->assignee, function ($query) {
                $query->whereHas('assignees', function ($q) {
                    $q->where('agent_id', $this->assignee);
                });
            })
            ->when($this->label, function ($query) {
                $query->whereHas('labels', function ($q) {
                    $q->where('slug', $this->label);
                });
            });

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.ticket.ticket-list', [
            'tickets' => $this->rows,
        ])->layout('layouts.app');
    }
}
