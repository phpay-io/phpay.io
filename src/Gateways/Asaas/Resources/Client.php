<?php

namespace PHPay\Gateways\Asaas\Resources;

use PHPay\Gateways\Asaas\Resources\Interfaces\ClientInterface;
use PHPay\Gateways\Gateway;

final class Client implements ClientInterface
{
    /**
     * construct
     *
     * @param array $client
     * @param Gateway $gateway
     */
    public function __construct(ClientEntity $client)
    {
        // code here
    }
}
