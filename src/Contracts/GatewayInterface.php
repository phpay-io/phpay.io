<?php

namespace PHPay\Contracts;

use Asaas\Resources\Customer\Customer as AsaasCustomer;
use Asaas\Resources\Charge\Charge as AsaasCharge;
use Asaas\Resources\Webhook\Webhook as AsaasWebhook;

interface GatewayInterface
{
    public function customer(array $customer = []): AsaasCustomer;
    public function charge(array $charge = []): AsaasCharge;
    public function webhook(array $webhook = []): AsaasWebhook;
}
