<?php

namespace Asaas\Interface;

use Asaas\Resources\Charge\Charge;
use Asaas\Resources\Customer\Customer;
use Asaas\Resources\Webhook\Webhook;
use PHPay\Contracts\GatewayInterface;

interface AsaasGatewayInterface extends GatewayInterface
{
    /**
     * get resource customer from gateway.
     *
     * @param array<mixed> $customer
     * @return Customer
     */
    public function customer(array $customer = []): Customer;

    /**
     * get resource charge from gateway.
     *
     * @param array<mixed> $charge
     * @return Charge
     */
    public function charge(array $charge = []): Charge;

    /**
     * get resource webhook from gateway.
     *
     * @param array<mixed> $webhook
     * @return Webhook
     */
    public function webhook(array $webhook = []): Webhook;
}
