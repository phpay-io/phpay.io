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
    public string $name;

    /**
     * @var string
     */
    public string $cpfCnpj;

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
            $response = $this->client->get('customers');

            $content = $response
                ->getBody()
                ->getContents();

            return json_decode($content, true);
        } catch (\Exception $e) {
            return $e->getMessage();
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
}
