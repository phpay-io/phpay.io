<?php

namespace PHPay;

use Efi\Interface\EfiGatewayInterface;
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
     * ATTENTION!!! ONLY EFÍ GATEWAY
     * get token.
     *
     * @return array<mixed>
     */
    public function getToken(): array
    {
        /**
         * @var EfiGatewayInterface $gateway
         */
        $gateway = $this->gateway;

        return $gateway->getToken();
    }

    /**
     * get resource customer from gateway.
     *
     * @param array<mixed> $customer
     * @return object
     */
    public function customer(array $customer = []): object
    {
        return $this->gateway->customer($customer);
    }

    /**
     * get resource charge from gateway.
     *
     * @param array<mixed> $charge
     * @return object
     */
    public function charge(array $charge = []): object
    {
        return $this->gateway->charge($charge);
    }

    /**
     * get resource webhook from gateway.
     *
     * @param array<mixed> $webhook
     * @return object
     */
    public function webhook(array $webhook = []): object
    {
        return $this->gateway->webhook($webhook);
    }
}
