<?php

namespace Asaas\Resources\Customer;

use Asaas\Requests\AsaasCustomerRequest;
use Asaas\Resources\Customer\Interface\CustomerInterface;
use Asaas\Traits\HasAsaasClient;
use GuzzleHttp\Client;

class Customer implements CustomerInterface
{
    /**
     * trait asaas client
     */
    use HasAsaasClient;

    /**
     * client guzzle
     */
    private Client $client;

    /**
     * @var array
     */
    private array $filter = [];

    /**
     * construct
     *
     * @param array $customer
     */
    public function __construct(
        private string $token,
        private array $customer = [],
        private bool $sandbox = true
    ) {
        $this->client = $this->clientAsaasBoot();

        if (!empty($customer)) {
            $this->customer = $customer;
        }

        return $this;
    }

    /**
     * get all customers
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->get('customers', [
            'query' => $this->filter,
        ]);
    }

    /**
     * get customer by id
     *
     * @param string $id
     * @return array
     */
    public function find(string $id): array
    {
        return $this->get("customers/{$id}");
    }

    /**
     * create customer
     *
     * @return array
     * @see available fields in https://docs.asaas.com/reference/criar-novo-cliente
     */
    public function create(): array
    {
        AsaasCustomerRequest::validate($this->customer);

        return $this->post('customers', $this->customer);
    }

    /**
     * update customer
     *
     * @param string $id
     * @return array
     * @see available fields in https://docs.asaas.com/reference/criar-novo-cliente
     */
    public function update(string $id): array
    {
        return $this->put("customers/{$id}", $this->customer);
    }

    /**
     * destroy customer
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->delete("customers/{$id}");
    }

    /**
     * restore customer deleted
     *
     * @param string $id
     * @return array
     */
    public function restore(string $id): array
    {
        return $this->post("customers/{$id}/restore");
    }

    /**
     * get notifications
     *
     * @param string $id
     * @return array
     */
    public function getNotifications(string $id): array
    {
        return $this->get("customers/{$id}/notifications");
    }

    /**
     * set filter
     *
     * @param array $filter
     * @return CustomerInterface
     */
    public function setFilter(array $filter = []): CustomerInterface
    {
        $this->filter = $filter;

        return $this;
    }
}
