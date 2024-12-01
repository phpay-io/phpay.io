<?php

namespace Payhub\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use Payhub\Exceptions\AsaasExceptions;

class Auth
{
    /**
     * Auth constructor.
     *
     * @param array $credentials
     * @param bool $sandbox
     */
    public function __invoke(array $credentials, bool $sandbox): void
    {
        $baseUrl = $sandbox ?
                'https://sandbox.asaas.com/api/v3' :
                'https://api.asaas.com/v3';

        extract($credentials);

        if (! isset($token)) {
            throw (new AsaasExceptions())('As credenciais do asaas precisam de um parâmetro token.');
        }

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
