<?php

namespace PHPay\Contracts;

interface GatewayInterface
{
    /**
     * get resource customer from gateway.
     *
     * @param array<mixed> $customer
     * @return object
     */
    public function customer(array $customer = []): object;

    /**
     * get resource charge from gateway.
     *
     * @param array<mixed> $charge
     * @return object
     */
    public function charge(array $charge = []): object;

    /**
     * get resource webhook from gateway.
     *
     * @param array<mixed> $webhook
     * @return object
     */
    public function webhook(array $webhook = []): object;

    /**
     * get resource pix from gateway.
     *
     * @param array<mixed> $pix
     * @return object
     */
    public function pix(array $pix = []): object;
}
