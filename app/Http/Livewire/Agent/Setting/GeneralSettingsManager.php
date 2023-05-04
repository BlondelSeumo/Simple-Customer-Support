<?php

namespace App\Http\Livewire\Agent\Setting;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class GeneralSettingsManager extends Component
{
    use WithFileUploads;

    public $siteName;
    public $siteDescription;
    public $logoFile;
    public $logoPath;
    public $faviconFile;
    public $faviconPath;
    public $announcementEnabled;
    public $announcementMessage;
    public $announcementLink;
    public $announcementLinkText;
    public $cookieConsentEnabled;
    public $cookieConsentMessage;
    public $cookieConsentAgree;
    public $enableUserRegistration;
    public $reCaptchaEnabled;
    public $reCaptchaSiteKey;
    public $reCaptchaSecretKey;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        abort_if(! auth()->user()->is_admin, 403);

        $this->siteName = $this->generalSettings->site_name;
        $this->siteDescription = $this->generalSettings->site_description;
        $this->logoPath = $this->generalSettings->logo_path;
        $this->faviconPath = $this->generalSettings->favicon_path;
        $this->announcementEnabled = $this->generalSettings->announcement_enabled;
        $this->announcementMessage = $this->generalSettings->announcement_message;
        $this->announcementLink = $this->generalSettings->announcement_link;
        $this->announcementLinkText = $this->generalSettings->announcement_link_text;
        $this->cookieConsentEnabled = $this->generalSettings->cookie_consent_enabled;
        $this->cookieConsentMessage = $this->generalSettings->cookie_consent_message;
        $this->cookieConsentAgree = $this->generalSettings->cookie_consent_agree;
        $this->enableUserRegistration = $this->generalSettings->enable_user_registration;
        $this->reCaptchaEnabled = $this->generalSettings->recaptcha_enabled;
        $this->reCaptchaSiteKey = $this->generalSettings->recaptcha_site_key;
        $this->reCaptchaSecretKey = $this->generalSettings->recaptcha_secret_key;
    }

    public function updatedLogoFile()
    {
        $this->validate([
            'logoFile' => 'image|max:1024',
        ]);
    }

    public function updatedFaviconFile()
    {
        $this->validate([
            'faviconFile' => 'image|max:1024',
        ]);
    }

    public function removeLogo()
    {
        tap($this->generalSettings->logo_path, function ($previous) {
            $this->generalSettings->logo_path = "";
            $this->generalSettings->save();
            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
        $this->reset('logoPath');
        $this->notify(trans('Logo has been removed.'));
    }

    public function removeFavicon()
    {
        tap($this->generalSettings->favicon_path, function ($previous) {
            $this->generalSettings->favicon_path = "";
            $this->generalSettings->save();
            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
        $this->reset('faviconPath');
        $this->notify(trans('Favicon has been removed.'));
    }

    public function saveGeneralInformation()
    {
        $this->validate([
            'siteName' => 'required|string',
            'siteDescription' => 'required|string',
        ]);
        if ($this->logoFile) {
            $this->generalSettings->logo_path = $this->logoFile->storePubliclyAs('photos', 'logo.' . $this->logoFile->getClientOriginalExtension(), ['disk' => 'public']);
            $this->logoPath = $this->generalSettings->logo_path;
        }
        if ($this->faviconFile) {
            $this->generalSettings->favicon_path = $this->faviconFile->storePubliclyAs('photos', 'favicon.' . $this->faviconFile->getClientOriginalExtension(), ['disk' => 'public']);
            $this->faviconPath = $this->generalSettings->favicon_path;
        }
        $this->generalSettings->site_name = $this->siteName;
        $this->generalSettings->site_description = $this->siteDescription;
        $this->generalSettings->save();
        $this->emitSelf('general-information-settings-saved');
    }

    public function saveAnnouncementSettings()
    {
        $this->validate([
            'announcementEnabled' => 'nullable|boolean',
            'announcementMessage' => 'required_if:announcementEnabled,true|string',
            'announcementLink' => 'required_if:announcementEnabled,true|url',
            'announcementLinkText' => 'required_if:announcementEnabled,true|string',
        ]);
        $this->generalSettings->announcement_enabled = $this->announcementEnabled;
        $this->generalSettings->announcement_message = $this->announcementMessage;
        $this->generalSettings->announcement_link = $this->announcementLink;
        $this->generalSettings->announcement_link_text = $this->announcementLinkText;
        $this->generalSettings->save();
        $this->emitSelf('announcement-settings-saved');
    }

    public function saveCookieConsentSettings()
    {
        $this->validate([
            'cookieConsentEnabled' => 'nullable|boolean',
            'cookieConsentMessage' => 'required_if:cookieConsentEnabled,true|string',
            'cookieConsentAgree' => 'required_if:cookieConsentEnabled,true|string',
        ]);
        $this->generalSettings->cookie_consent_enabled = $this->cookieConsentEnabled;
        $this->generalSettings->cookie_consent_message = $this->cookieConsentMessage;
        $this->generalSettings->cookie_consent_agree = $this->cookieConsentAgree;
        $this->generalSettings->save();
        $this->emitSelf('cookie-consent-settings-saved');
    }

    public function saveUserRegistrationSettings()
    {
        $this->validate([
            'enableUserRegistration' => 'nullable|boolean',
        ]);
        $this->generalSettings->enable_user_registration = $this->enableUserRegistration;
        $this->generalSettings->save();
        $this->emitSelf('user-registration-settings-saved');
    }

    public function saveReCaptchaSettings()
    {
        $this->validate([
            'reCaptchaEnabled' => 'nullable|boolean',
            'reCaptchaSiteKey' => 'required_if:reCaptchaEnabled,true|string',
            'reCaptchaSecretKey' => 'required_if:reCaptchaEnabled,true|string',
        ]);
        $this->generalSettings->recaptcha_enabled = $this->reCaptchaEnabled;
        $this->generalSettings->recaptcha_site_key = $this->reCaptchaSiteKey;
        $this->generalSettings->recaptcha_secret_key = $this->reCaptchaSecretKey;
        $this->generalSettings->save();
        $this->emitSelf('re-captcha-settings-saved');
    }

    public function getGeneralSettingsProperty()
    {
        return app(\App\Settings\GeneralSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.setting.general-settings-manager');
    }
}
