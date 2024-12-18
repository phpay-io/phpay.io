<?php

namespace PHPay;

use PHPay\Contracts\GatewayInterface;

class PHPay implements GatewayInterface
{
    /**
     * instance of PHPay.
     *
     * @param GatewayInterface $gateway
     */
    public function __construct(
        protected GatewayInterface $gateway
    ) {
        $this->gateway = $gateway;
    }

    /**
     * get resource customer from gateway.
     *
     * @param array $customer
     * @return object
     */
    public function customer(array $customer = []): object
    {
        return $this->gateway->customer($customer);
    }

    /**
     * get resource charge from gateway.
     *
     * @param array $charge
     * @return object
     */
    public function charge(array $charge = []): object
    {
        return $this->gateway->charge($charge);
    }

    /**
     * get resource webhook from gateway.
     *
     * @param array $webhook
     * @return object
     */
    public function webhook(array $webhook = []): object
    {
        return $this->gateway->webhook($webhook);
    }
}
