<?php

namespace PHPay\Contracts;

use PHPay\Gateways\Asaas\Resources\Client;

interface GatewayInterface
{
    public function __construct(string $token, bool $sandbox = true);
    public function client(array $client): object;
    public function invoice(array $invoice): object;
}
