<?php

namespace PHPay\Contracts;

use Asaas\Resources\Customer\Customer as AsaasCustomer;

interface GatewayInterface
{
    public function customer(array $customer = []): AsaasCustomer;
}
