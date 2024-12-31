<?php

use PHPay\Asaas\AsaasGateway;
use PHPay\Contracts\GatewayInterface;
use PHPay\PHPay;

$phpay = new PHPay(new AsaasGateway('token'));

it('test phpay suite', function () use ($phpay) {
    expect($phpay)
        ->toBeInstanceOf(PHPay::class)
        ->toHaveProperty('gateway')
        ->toBeInstanceOf(GatewayInterface::class);
});
