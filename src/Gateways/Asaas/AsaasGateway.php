<?php

namespace PHPay\Gateways\Asaas;

use Asaas\Resources\Charge\Charge;
use Asaas\Resources\Customer\Customer;
use Asaas\Resources\Webhook\Webhook;
use GuzzleHttp\Client;
use PHPay\Contracts\GatewayInterface;

class AsaasGateway implements GatewayInterface
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
     * @param array $customer
     * @return Customer
     */
    public function customer(array $customer = []): Customer
    {
        $this->customer = new Customer($customer, $this->token, $this->sandbox);

        return $this->customer;
    }

    /**
     * charge
     *
     * @param array $charge
     * @return Charge
     */
    public function charge(array $charge = []): Charge
    {
        return new Charge($charge, $this->token, $this->sandbox);
    }

    public function webhook(array $webhook = []): Webhook
    {
        return new Webhook($webhook, $this->token, $this->sandbox);
    }
}
