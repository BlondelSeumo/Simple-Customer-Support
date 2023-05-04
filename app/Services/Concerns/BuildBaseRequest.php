<?php

namespace App\Services\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait BuildBaseRequest
{
    public function buildRequestWithToken($token): PendingRequest
    {
        return $this
            ->withBaseUrl()
            ->acceptJson()
            ->timeout(
                seconds: 15,
            )
            ->withToken(
                token: $token,
            );
    }

    public function buildRequestWithDigestAuth($username, $password): PendingRequest
    {
        return $this
            ->withBaseUrl()
            ->acceptJson()
            ->timeout(
                seconds: 15,
            )
            ->withDigestAuth(
                username: $username,
                password: $password,
            );
    }

    public function withBaseUrl(): PendingRequest
    {
        return Http::baseUrl(
            url: $this->apiUrl,
        );
    }
}
