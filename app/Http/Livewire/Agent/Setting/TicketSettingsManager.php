<?php

namespace App\Http\Livewire\Agent\Setting;

use App\Settings\TicketSettings;
use Livewire\Component;

class TicketSettingsManager extends Component
{
    public $allowAssignmentToAdmins;
    public $allowAgentToAssignTicket;
    public $allowAgentToResignTicket;
    public $allowAgentToSeeLicenseCode;
    public $autoAssignmentEnabled;
    public $autoAssignmentUseRandomAgent;
    public $maxCommentsPerPage;
    public $maxAttachmentUploadSize;
    public $maxImageUploadSize;

    protected $rules = [
        'allowAssignmentToAdmins' => 'boolean',
        'allowAgentToAssignTicket' => 'boolean',
        'allowAgentToResignTicket' => 'boolean',
        'allowAgentToSeeLicenseCode' => 'boolean',
        'autoAssignmentEnabled' => 'boolean',
        'maxCommentsPerPage' => 'integer|min:1|max:9999',
        'maxAttachmentUploadSize' => 'integer|min:1',
        'maxImageUploadSize' => 'integer|min:1',
    ];

    public function mount()
    {
        abort_if(! auth()->user()->is_admin, 403);
        $this->allowAssignmentToAdmins = $this->ticketSettings->allow_assignment_to_admins;
        $this->allowAgentToAssignTicket = $this->ticketSettings->allow_agent_to_assign_ticket;
        $this->allowAgentToResignTicket = $this->ticketSettings->allow_agent_to_resign_ticket;
        $this->allowAgentToSeeLicenseCode = $this->ticketSettings->allow_agent_to_see_license_code;
        $this->autoAssignmentEnabled = $this->ticketSettings->auto_assignment_enabled;
        $this->autoAssignmentUseRandomAgent = $this->ticketSettings->auto_assignment_use_random_agent;
        $this->maxCommentsPerPage = $this->ticketSettings->max_comments_per_page;
        $this->maxAttachmentUploadSize = $this->ticketSettings->max_attachment_upload_size;
        $this->maxImageUploadSize = $this->ticketSettings->max_image_upload_size;
    }

    public function save()
    {
        $this->validate();
        $this->ticketSettings->allow_assignment_to_admins = $this->allowAssignmentToAdmins;
        $this->ticketSettings->allow_agent_to_assign_ticket = $this->allowAgentToAssignTicket;
        $this->ticketSettings->allow_agent_to_resign_ticket = $this->allowAgentToResignTicket;
        $this->ticketSettings->allow_agent_to_see_license_code = $this->allowAgentToSeeLicenseCode;
        $this->ticketSettings->auto_assignment_enabled = $this->autoAssignmentEnabled;
        $this->ticketSettings->auto_assignment_use_random_agent = $this->autoAssignmentUseRandomAgent;
        $this->ticketSettings->max_comments_per_page = $this->maxCommentsPerPage;
        $this->ticketSettings->max_attachment_upload_size = $this->maxAttachmentUploadSize;
        $this->ticketSettings->max_image_upload_size = $this->maxImageUploadSize;
        $this->ticketSettings->save();
        $this->emitSelf('saved');
    }

    public function getTicketSettingsProperty()
    {
        return app(TicketSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.setting.ticket-settings-manager');
    }
}
