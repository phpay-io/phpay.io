<?php

namespace Payhub\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use Payhub\Exceptions\AsaasExceptions;

final class Auth
{
    /**
     * Auth constructor.
     *
     * @param array $credentials
     * @param bool $sandbox
     */
    public function __construct(array $credentials, bool $sandbox)
    {
        $baseUrl = $sandbox ?
            env('ASAAS_URL_SANDBOX') :
            env('ASAAS_URL');

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
