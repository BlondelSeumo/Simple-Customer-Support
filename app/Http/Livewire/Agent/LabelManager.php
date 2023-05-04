<?php

namespace App\Http\Livewire\Agent;

use App\Actions\RandomColor;
use App\Models\Label;
use Livewire\Component;
use Livewire\WithPagination;

class LabelManager extends Component
{
    use WithPagination;

    public $label;
    public $search;
    public $showLabelForm = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $rules = [
        'label.name' => 'required|string|max:255',
        'label.color' => 'required|string|max:6',
        'label.description' => 'nullable|string|max:255',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createLabel()
    {
        $this->label = new Label();
        $this->label->color = RandomColor::generate();
        $this->showLabelForm = true;
    }

    public function saveLabel()
    {
        $this->validate();
        $this->label->save();
        $this->dispatchBrowserEvent('notify', $this->label->wasRecentlyCreated ? trans('Label has been created.') : trans('Label has been updated.'));
        $this->reset('label', 'showLabelForm');
    }

    public function editLabel(Label $label)
    {
        $this->label = $label;
        $this->showLabelForm = true;
    }

    public function deleteLabel(Label $label)
    {
        $label->delete();
        $this->reset('label', 'showLabelForm');
        $this->notify(trans('Label has been removed.'));
    }

    public function generateLabelColor()
    {
        $this->label->color = RandomColor::generate();
    }

    public function getLabelsProperty()
    {
        return Label::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->withCount('tickets')
            ->latest()
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.label-manager');
    }
}
