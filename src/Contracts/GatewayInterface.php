<?php

namespace PHPay\Contracts;

interface GatewayInterface
{
    public function __construct(string $token, $sandbox = true, array $settings = []);
    public function client(array $client, bool $createOnly = true): object;
    public function invoice(array $invoice, bool $createOnly = true): object;
}
