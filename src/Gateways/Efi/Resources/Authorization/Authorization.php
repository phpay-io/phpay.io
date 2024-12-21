<?php

namespace Efi\Resources\Authorization;

use Efi\Resources\Authorization\Interface\AuthorizationInterface;
use Efi\Traits\HasEfiClient;
use GuzzleHttp\Client;

class Authorization implements AuthorizationInterface
{
    use HasEfiClient;

    /**
     * client guzzle
     */
    public Client $client;

    /**
     * construct
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param bool $sandbox
     */
    public function __construct(
        private string $clientId,
        private string $clientSecret,
        protected bool $sandbox = true
    ) {
    }

    /**
     * get token
     *
     * @return array<string>
     */
    public function getToken(): array
    {
        $this->client = $this->clientEfiAuthorize($this->clientId, $this->clientSecret);

        /**
         * @var array<string> $response
         */
        $response = $this->post("v1/authorize", [
            'grant_type' => 'client_credentials',
        ]);

        return $response;
    }
}
