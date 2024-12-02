<?php

namespace PHPay\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use PHPay\Exceptions\AsaasExceptions;

final class Auth
{
    /**
     * Auth constructor.
     *
     * @param string $token
     * @param bool $sandbox
     */
    public function __construct(string $token, bool $sandbox)
    {
        $baseUrl = $sandbox ?
            env('ASAAS_URL_SANDBOX') :
            env('ASAAS_URL');

        Http::macro('asaas', function () use ($token, $baseUrl) {
            return Http::acceptJson()
                ->baseUrl($baseUrl)
                ->withHeaders([
                    'content-type' => 'application/json',
                    'user-agent' => 'payhub',
                    'access_token' => $token,
                ]);
        });
    }
}
