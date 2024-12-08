<?php

namespace PHPay\Gateways;

abstract class Gateway
{
    public array $client;

    public array $invoice;
    abstract public function client(array $client, bool $createOnly = true): object;
    abstract public function invoice(array $invoice, bool $createOnly = true): object;
}
