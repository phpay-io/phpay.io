<?php

namespace PHPay\Contracts;

use Asaas\Resources\Charge\Charge as AsaasCharge;
use Asaas\Resources\Customer\Customer as AsaasCustomer;

interface GatewayInterface
{
    public function customer(array $customer = []): AsaasCustomer;
    public function charge(array $charge = []): AsaasCharge;
}
