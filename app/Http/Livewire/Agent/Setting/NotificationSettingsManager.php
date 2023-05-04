<?php

namespace App\Http\Livewire\Agent\Setting;

use App\Settings\NotificationSettings;
use Livewire\Component;

class NotificationSettingsManager extends Component
{
    public $sendTicketConfirmationToAdmins;
    public $sendTicketConfirmationToProductManagers;
    public $sendTicketConfirmationToTicketAssignees;

    protected $rules = [
        'sendTicketConfirmationToAdmins' => 'boolean',
        'sendTicketConfirmationToProductManagers' => 'boolean',
        'sendTicketConfirmationToTicketAssignees' => 'boolean',
    ];

    public function mount()
    {
        abort_if(! auth()->user()->is_admin, 403);
        $this->sendTicketConfirmationToAdmins = $this->notificationSettings->send_ticket_confirmation_to_admins;
        $this->sendTicketConfirmationToProductManagers = $this->notificationSettings->send_ticket_confirmation_to_product_managers;
        $this->sendTicketConfirmationToTicketAssignees = $this->notificationSettings->send_ticket_confirmation_to_ticket_assignees;
    }

    public function save()
    {
        $this->validate();
        $this->notificationSettings->send_ticket_confirmation_to_admins = $this->sendTicketConfirmationToAdmins;
        $this->notificationSettings->send_ticket_confirmation_to_product_managers = $this->sendTicketConfirmationToProductManagers;
        $this->notificationSettings->send_ticket_confirmation_to_ticket_assignees = $this->sendTicketConfirmationToTicketAssignees;
        $this->notificationSettings->save();
        $this->emitSelf('saved');
    }

    public function getNotificationSettingsProperty()
    {
        return app(NotificationSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.setting.notification-settings-manager');
    }
}
