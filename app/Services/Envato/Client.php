<?php

namespace App\Services\Envato;

use App\Services\Concerns\BuildBaseRequest;
use App\Services\Concerns\CanSendGetRequest;
use App\Services\Concerns\CanSendPostRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class Client
{
    use BuildBaseRequest;
    use CanSendGetRequest;
    use CanSendPostRequest;

    public function __construct(
        protected string $apiUrl,
        protected string $userAgent,
    ) {}

    /**
     * @throws RequestException
     */
    public function renewAccessToken($refreshToken, $clientId, $clientSecret)
    {
        return $this
            ->post(
                request: $this->withBaseUrl()->timeout(15),
                url: "/token",
                payload: [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refreshToken,
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ],
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function whoAmI($accessToken)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($accessToken)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/whoami",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function getUserEmail($token)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($token)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/v1/market/private/user/email.json",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function getUserUsername($token)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($token)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/v1/market/private/user/username.json",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function getNewItems($token, $userName, $siteName)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($token)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/v1/market/new-files-from-user:$userName,$siteName.json",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function getPurchasesFromAppCreator($token)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($token)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/v3/market/buyer/purchases",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function getPurchase($accessToken, $purchaseCode)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($accessToken)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/v3/market/buyer/purchase?code=$purchaseCode",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }

    /**
     * @throws RequestException
     */
    public function getAuthorSale($token, $purchaseCode)
    {
        return $this
            ->get(
                request: $this->buildRequestWithToken($token)->withHeaders(['User-Agent' => $this->userAgent]),
                url: "/v3/market/author/sale?code=$purchaseCode",
            )
            ->throw(fn($response) => $response->failed())
            ->json();
    }
}
