<?php

namespace PHPay\Gateways;

abstract class Gateway
{
    public array $client;
    abstract public function client(array $client = []): object;
    abstract public function invoice(array $invoice): object;
}
