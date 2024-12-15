<?php

namespace PHPay\Gateways\Asaas;

use Asaas\Resources\Customer\Customer;
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
}
