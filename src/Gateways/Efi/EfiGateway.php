<?php

namespace PHPay\Gateways\Efi;

use Efi\Interface\EfiGatewayInterface;
use Efi\Resources\Authorization\Authorization;
use Efi\Traits\HasEfiClient;
use GuzzleHttp\Client;
use stdClass;

class EfiGateway implements EfiGatewayInterface
{
    use HasEfiClient;

    /**
     * client guzzle
     */
    public Client $client;

    /**
     * construct
     *
     * @param bool $sandbox
     */
    public function __construct(
        private bool $sandbox = true
    ) {
    }

    /**
     * autorization
     *
     * @param string $clientId
     * @param string $clientSecret
     * @return Authorization
     */
    public function authorization(string $clientId, string $clientSecret): Authorization
    {
        return new Authorization($clientId, $clientSecret, $this->sandbox);
    }

    /**
     * create charge
     *
     * @param array<string> $charge
     * @return object charge
     */
    public function charge(array $charge = []): object
    {
        return new stdClass();
    }

    /**
     * create customer
     *
     * @param array<string> $customer
     * @return object customer
     */
    public function customer(array $customer = []): object
    {
        return new stdClass();
    }

    /**
     * create webhook
     *
     * @param array<string> $webhook
     * @return object webhook
     */
    public function webhook(array $webhook = []): object
    {
        return new stdClass();
    }
}
