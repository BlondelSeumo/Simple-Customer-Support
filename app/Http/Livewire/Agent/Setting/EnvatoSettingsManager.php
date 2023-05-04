<?php

namespace App\Http\Livewire\Agent\Setting;

use App\Services\Envato\Client;
use Illuminate\Http\Client\RequestException;
use Livewire\Component;

class EnvatoSettingsManager extends Component
{
    public $tokenEnabled;
    public $oauthEnabled;
    public $accountToken;
    public $accountEmail;
    public $accountUsername;
    public $oauthClientId;
    public $oauthClientSecret;

    public function mount()
    {
        abort_if(! auth()->user()->is_admin, 403);

        $this->tokenEnabled = $this->envatoSettings->token_enabled;
        $this->oauthEnabled = $this->envatoSettings->oauth_enabled;
        $this->accountToken = $this->envatoSettings->account_token;
        $this->accountEmail = $this->envatoSettings->account_email;
        $this->accountUsername = $this->envatoSettings->account_username;
        $this->oauthClientId = $this->envatoSettings->oauth_client_id;
        $this->oauthClientSecret = $this->envatoSettings->oauth_client_secret;
    }

    public function savePersonalToken()
    {
        $this->validate([
            'tokenEnabled' => 'required|boolean',
            'accountToken' => 'required_if:tokenEnabled,true|string',
        ]);
        if ($this->tokenEnabled) {
            try {
                $client = app(Client::class);
                $accountEmail = $client->getUserEmail($this->accountToken);
                $accountUsername = $client->getUserUsername($this->accountToken);
            } catch (\Exception $e) {
                if ($e instanceof RequestException) {
                    $this->addError('accountToken', $e->response->json('error'));
                } else {
                    $this->addError('accountToken', $e->getMessage());
                }
                return;
            }
            $this->envatoSettings->account_token = $this->accountToken;
            $this->envatoSettings->account_email = $accountEmail['email'];
            $this->envatoSettings->account_username = $accountUsername['username'];
        }
        $this->envatoSettings->token_enabled = $this->tokenEnabled;
        $this->envatoSettings->save();
        $this->notify(trans('Settings saved successful.'));
    }

    public function removePersonalToken()
    {
        $this->envatoSettings->token_enabled = false;
        $this->envatoSettings->account_token = '';
        $this->envatoSettings->account_email = '';
        $this->envatoSettings->account_username = '';
        $this->envatoSettings->save();
        $this->reset('tokenEnabled', 'accountToken');
    }

    public function saveOAuthCredentials()
    {
        $this->validate([
            'oauthEnabled' => 'required|boolean',
            'oauthClientId' => 'required_if:oauthEnabled,true|string',
            'oauthClientSecret' => 'required_if:oauthEnabled,true|string',
        ]);
        $this->envatoSettings->oauth_enabled = $this->oauthEnabled;
        $this->envatoSettings->oauth_client_id = $this->oauthClientId;
        $this->envatoSettings->oauth_client_secret = $this->oauthClientSecret;
        $this->envatoSettings->save();
        $this->notify(trans('Settings saved successful.'));
    }

    public function removeOAuthCredentials()
    {
        $this->envatoSettings->oauth_enabled = false;
        $this->envatoSettings->oauth_client_id = '';
        $this->envatoSettings->oauth_client_secret = '';
        $this->envatoSettings->save();
        $this->reset('oauthEnabled', 'oauthClientId', 'oauthClientSecret');
    }

    public function getEnvatoSettingsProperty()
    {
        return app(\App\Settings\EnvatoSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.setting.envato-settings-manager');
    }
}
