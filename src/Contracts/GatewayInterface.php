<?php

namespace PHPay\Contracts;

interface GatewayInterface
{
    public function customer(array $customer = []): object;
    public function charge(array $charge = []): object;
    public function webhook(array $webhook = []): object;
}
