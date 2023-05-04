<?php

namespace App\Http\Livewire\Agent\Ticket;

use App\Actions\RandomColor;
use App\Events\TicketStatusUpdated;
use App\Models\Agent;
use App\Models\Label;
use App\Models\Ticket;
use App\Services\Envato\Client;
use App\Settings\EnvatoSettings;
use App\Settings\TicketSettings;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TicketDetails extends Component
{
    use AuthorizesRequests;

    public Ticket $ticket;

    public $newLabel;

    public $isCreatingNewLabel = false;

    public $showLicenseDetails = false;

    public $filters = [
        'labelName' => '',
        'agentName' => '',
    ];

    protected $listeners = ['refresh' => '$refresh'];

    protected $rules = [
        'ticket.license_code' => 'required|string',
        'newLabel.name' => 'required|string|max:255',
        'newLabel.color' => 'required|string|max:6',
        'newLabel.description' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->authorize('view', $this->ticket);

        $this->ticket->load('product.media', 'category', 'user', 'assignees.media', 'labels');
    }

    public function toggleLabel(Label $label)
    {
        if (in_array($label->id, $this->ticket->labels->pluck('id')->toArray())) {
            $this->ticket->labels()->detach($label);
        } else {
            $this->ticket->labels()->attach($label);
        }
        $this->ticket->load('labels');
    }

    public function generateLabelColor()
    {
        $this->newLabel->color = RandomColor::generate();
    }

    public function createNewLabel()
    {
        $this->newLabel = new Label([
            'name' => $this->filters['labelName'],
            'color' => RandomColor::generate(),
        ]);
        $this->isCreatingNewLabel = true;
    }

    public function saveNewLabel()
    {
        $this->validate([
            'newLabel.name' => 'required|string|max:255',
            'newLabel.color' => 'required|string|max:6',
            'newLabel.description' => 'nullable|string|max:255',
        ]);
        $this->newLabel->save();
        $this->ticket->labels()->attach($this->newLabel);
        $this->ticket->load('labels');
        $this->reset('newLabel');
        $this->isCreatingNewLabel = false;
    }

    public function toggleAssignee(Agent $agent)
    {
        if (in_array($agent->id, $this->ticket->assignees->pluck('id')->toArray())) {
            $this->ticket->assignees()->detach($agent);
        } else {
            $this->ticket->assignees()->attach($agent);
        }
        $this->ticket->load('assignees');
    }

    public function updateTicketStatus($value)
    {
        $this->ticket->status = $value;
        $this->ticket->save();
        $this->emitTo('agent.sidebar-navigation', 'refresh');
        TicketStatusUpdated::dispatch(auth()->user(), $this->ticket);
    }

    public function updateTicketPriority($value)
    {
        $this->ticket->priority = $value;
        $this->ticket->save();
    }

    public function updateTicketLicenseCode(Client $client, $withVerification = false)
    {
        $this->validate([
            'ticket.license_code' => [
                'string',
                Rule::when($this->ticket->product->isFromEnvato, 'uuid'),
                Rule::when($withVerification, 'required', 'nullable'),
            ],
        ], [
            'ticket.license_code.required' => trans('The license code field can not leave blank.'),
            'ticket.license_code.uuid' => trans('The license code must be a valid format.'),
        ]);
        if ($withVerification && $this->ticket->product->is_from_envato) {
            try {
                $response = $client->getAuthorSale($this->envatoSettings->account_token, $this->ticket->license_code);
                if ($response['item']['id'] == $this->ticket->product->code) {
                    $this->ticket->license_name = $response['license'];
                    $this->ticket->license_purchased_at = Carbon::parse($response['sold_at']);
                    $this->ticket->license_support_ends_at = Carbon::parse($response['supported_until'])->toDateTimeString();
                    $this->ticket->license_verified_at = Carbon::now()->toDateTimeString();
                } else {
                    $this->addError('ticket.license_code', trans('Invalid license code.'));
                    return false;
                }
            } catch (\Exception $e) {
                logger($e);
                $this->addError('ticket.license_code', $e->response->json()['description']);
                return false;
            }
        }
        $this->ticket->save();
        $this->notify(trans('License code updated successfully.'));
    }

    public function deleteTicket()
    {
        $this->ticket->comments()->delete();
        $this->ticket->delete();
        $this->redirect(route('agent.tickets.list'));
    }

    public function getLabelsProperty()
    {
        return Label::query()
            ->when($this->filters['labelName'], function ($query) {
                $query->where('name', 'like', '%' . $this->filters['labelName'] . '%');
            })
            ->get();
    }

    public function getAgentsProperty()
    {
        return Agent::query()
            ->with('media')
            ->when(! $this->ticketSettings->allow_assignment_to_admins, function ($query) {
                $query->where('is_admin', false);
            })
            ->when(! $this->ticketSettings->allow_agent_to_resign_ticket, function ($query) {
                $query->where('id', '!=', auth()->id());
            })
            ->when($this->filters['agentName'], function ($query) {
                $query->where('name', 'like', '%' . $this->filters['agentName'] . '%');
            })
            ->get();
    }

    public function getCommentsCountProperty()
    {
        return $this->ticket->comments()->count();
    }

    public function getEnvatoSettingsProperty()
    {
        return app(EnvatoSettings::class);
    }

    public function getTicketSettingsProperty()
    {
        return app(TicketSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.ticket.ticket-details')->layout('layouts.app');
    }
}
