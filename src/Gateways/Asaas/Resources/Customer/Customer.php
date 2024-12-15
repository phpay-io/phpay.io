<?php

namespace Asaas\Resources\Customer;

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
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $cpfCnpj;

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
            $this->name    = $customer['name'];
            $this->cpfCnpj = $customer['cpfCnpj'];
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
     * @return string
     */
    public function create(): string
    {
        try {
            return $this->post('customers', [
                'name'    => $this->name,
                'cpfCnpj' => $this->cpfCnpj,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * delete customer
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        try {
            $response = $this->client->delete("customers/{$id}");

            return ($response->getStatusCode() === 200);
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
            $response = $this->client->post("customers/{$id}/restore");

            return ($response->getStatusCode() === 200);
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
