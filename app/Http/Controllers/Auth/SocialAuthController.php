<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Envato\Client;
use App\Settings\EnvatoSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Manager\Config;

class SocialAuthController extends Controller
{
    public function providerRedirectHandler(Request $request)
    {
        if ($request->filled('provider')) {
            $provider = $request->get('provider');

            return match ($provider) {
                'envato' => $this->envatoRedirect(),
                default => redirect()->route('login'),
            };
        }

        return redirect()->route('login');
    }

    public function ProviderCallbackHandler(Request $request)
    {
        if ($request->filled('provider')) {
            $provider = $request->get('provider');

            return match ($provider) {
                'envato' => $this->envatoCallback(),
                default => redirect()->route('login'),
            };
        }

        return redirect()->route('login');
    }

    public function envatoRedirect()
    {
        return $this->envatoDriver()->redirect();
    }

    public function envatoCallback()
    {
        $envatoUser = $this->envatoDriver()->user();

        $envatoClient = app(Client::class);

        try {
            $envatoUserId = $envatoClient->whoAmI($envatoUser->token)['userId'];
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['envato' => 'Unable to authenticate with Envato.']);
        }

        $user = User::updateOrCreate([
            'envato_id' => $envatoUserId,
        ], [
            'envato_id' => $envatoUserId,
            'name' => $envatoUser->name,
            'email' => $envatoUser->email,
            'envato_access_token' => $envatoUser->token,
            'envato_refresh_token' => $envatoUser->refreshToken,
        ]);

        Auth::login($user);

        return redirect()->route('guest.welcome');
    }

    protected function envatoDriver()
    {
        $envatoSettings = app(EnvatoSettings::class);

        $clientId = $envatoSettings->oauth_client_id;

        $clientSecret = $envatoSettings->oauth_client_secret;

        $callbackUri = route('social-login.callback', ['provider' => 'envato']);

        $driverConfig = new Config($clientId, $clientSecret, $callbackUri);

        return Socialite::driver('envato')->setConfig($driverConfig);
    }
}
