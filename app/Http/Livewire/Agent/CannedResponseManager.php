<?php

namespace App\Http\Livewire\Agent;

use App\Models\CannedResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CannedResponseManager extends Component
{
    public CannedResponse $response;
    public $search;
    public $showResponseForm = false;
    public $isEditingResponse = false;
    public $isCreatingResponse = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected $rules = [
        'response.agent_id' => 'required|exists:agents,id',
        'response.title' => 'required|string',
        'response.content' => 'required|string',
    ];

    public function mount()
    {
        $this->response = $this->makeBlankResponse();
    }

    public function makeBlankResponse()
    {
        return new CannedResponse([
            'agent_id' => Auth::id(),
        ]);
    }

    public function createResponse()
    {
        $this->resetErrorBag();
        $this->response = $this->makeBlankResponse();
        $this->isEditingResponse = false;
        $this->isCreatingResponse = true;
    }

    public function editResponse(CannedResponse $response)
    {
        $this->resetErrorBag();
        $this->response = $response;
        $this->isEditingResponse = true;
        $this->isCreatingResponse = false;
    }

    public function saveResponse()
    {
        $this->validate();
        $this->response->save();
        $this->response->wasRecentlyCreated ? $this->notify('New response has been created.') : $this->notify('Response has been updated.');
        $this->response = $this->makeBlankResponse();
        $this->reset('isCreatingResponse', 'isEditingResponse');
        $this->emitSelf('refresh');
    }

    public function deleteResponse(CannedResponse $response)
    {
        $response->delete();
        $this->response = $this->makeBlankResponse();
        $this->reset('isCreatingResponse', 'isEditingResponse');
        $this->emitSelf('refresh');
    }

    public function getCannedResponsesProperty()
    {
        return CannedResponse::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->where('agent_id', Auth::id())
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.agent.canned-response-manager');
    }
}
