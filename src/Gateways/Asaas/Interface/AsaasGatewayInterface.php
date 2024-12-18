<?php

namespace Asaas\Interface;

use Asaas\Resources\Charge\Charge;
use Asaas\Resources\Customer\Customer;
use Asaas\Resources\Webhook\Webhook;
use PHPay\Contracts\GatewayInterface;

interface AsaasGatewayInterface extends GatewayInterface
{
    public function customer(array $customer = []): Customer;
    public function charge(array $charge = []): Charge;
    public function webhook(array $webhook = []): Webhook;
}
