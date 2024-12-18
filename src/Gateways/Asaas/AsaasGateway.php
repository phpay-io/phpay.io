<?php

namespace PHPay\Gateways\Asaas;

use Asaas\Interface\AsaasGatewayInterface;
use Asaas\Resources\Charge\Charge;
use Asaas\Resources\Customer\Customer;
use Asaas\Resources\Webhook\Webhook;
use GuzzleHttp\Client;

class AsaasGateway implements AsaasGatewayInterface
{
    /**
     * client guzzle
     */
    public Client $client;

    /**
     * customer data
     *
     * @var Customer
     */
    public Customer $customer;

    /**
     * construct
     *
     * @param string $token
     * @param bool $sandbox
     */
    public function __construct(
        private string $token,
        private bool $sandbox = true
    ) {
    }

    /**
     * customer
     *
     * @param array<mixed> $customer
     * @return Customer
     */
    public function customer(array $customer = []): Customer
    {
        $this->customer = new Customer($this->token, $customer, $this->sandbox);

        return $this->customer;
    }

    /**
     * charge
     *
     * @param array<mixed> $charge
     * @return Charge
     */
    public function charge(array $charge = []): Charge
    {
        return new Charge($this->token, $charge, $this->sandbox);
    }

    /**
     * webhook
     *
     * @param array<mixed> $webhook
     * @return Webhook
     */
    public function webhook(array $webhook = []): Webhook
    {
        return new Webhook($this->token, $webhook, $this->sandbox);
    }
}
