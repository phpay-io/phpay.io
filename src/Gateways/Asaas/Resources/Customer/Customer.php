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
        private array $customer = [],
        private string $token,
        private bool $sandbox = true
    ) {
        $this->client = $this->clientAsaasBoot();

        if (!empty($customer)) {
            AsaasCustomerRequest::validate($customer);

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
        try {
            $response = $this->client->get('customers', [
                'query' => $this->filter,
            ]);

            $content = $response
                ->getBody()
                ->getContents();

            return json_decode($content, true);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * get customer by id
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        try {
            $response = $this->client->get("customers/{$id}");

            $content = $response
                ->getBody()
                ->getContents();

            return json_decode($content, true);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * create customer
     *
     * @return array
     * @see available fields in https://docs.asaas.com/reference/criar-novo-cliente
     */
    public function create(): array
    {
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
        try {
            return $this->put("customers/{$id}", $this->customer);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * destroy customer
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        try {
            return $this->delete("customers/{$id}");
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * restore customer deleted
     *
     * @param string $id
     * @return bool
     */
    public function restore(string $id): bool
    {
        try {
            return $this->post("customers/{$id}/restore");
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * get notifications
     *
     * @param string $id
     * @return array
     */
    public function getNotifications(string $id): array
    {
        try {
            $response = $this->client->get("customers/{$id}/notifications");

            $content = $response
                ->getBody()
                ->getContents();

            return json_decode($content, true);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
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
