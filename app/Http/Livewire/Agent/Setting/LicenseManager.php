<?php

namespace App\Http\Livewire\Agent\Setting;

use App\Settings\GeneralSettings;
use Livewire\Component;

class LicenseManager extends Component
{
    public $itemId = 39876536;
    public $purchaseCode;
    public $isActivated = false;

    protected $rules = [
        'purchaseCode' => 'required',
    ];

    protected $messages = [
        'purchaseCode.required' => 'Please enter your purchase code!',
        'purchaseCode.uuid' => 'Purchase code is invalid format!',
    ];

    public function mount()
    {
        $this->purchaseCode = $this->generalSettings->purchase_code;
        $this->isActivated = $this->generalSettings->purchase_code;
    }

    public function activate()
    {
        $this->validate();
        $this->requestLicenseActivation();
    }

    public function deactivate()
    {
        $this->requestLicenseDeactivation();
    }

    public function requestLicenseActivation()
    {
		$this->generalSettings->purchase_code = $this->purchaseCode;
		$this->generalSettings->save();
		$this->isActivated = true;
		$this->notify(trans('License successfully activated!'));
		return true;
    }

    public function requestLicenseDeactivation()
    {
        $response = \Http::post('https://novabolt.dev/api/licenses/deactivate', [
            'purchase_code' => $this->purchaseCode,
            'domain' => request()->getHost(),
        ]);

        logger($response->json());

        if ($response->failed()) {
            $this->addError('purchaseCode', $response->json('message'));
            return false;
        } else {
            $this->generalSettings->purchase_code = '';
            $this->generalSettings->save();
            $this->isActivated = false;
            $this->notify(trans('License successfully deactivated!'));
            return true;
        }
    }

    public function getGeneralSettingsProperty()
    {
        return app(GeneralSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.setting.license-manager');
    }
}
