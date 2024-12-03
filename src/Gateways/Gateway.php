<?php

namespace PHPay\Gateways;

abstract class Gateway
{
    abstract public function client(array $client = []): object;
    abstract public function invoice(array $invoice): object;
}
