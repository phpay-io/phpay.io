<?php

namespace Efi\Resources\Charge;

use Efi\Resources\Charge\Interface\ChargeInterface;
use Efi\Traits\HasEfiClient;
use GuzzleHttp\Client;

class Charge implements ChargeInterface
{
    /**
     * trait Efi client
     */
    use HasEfiClient;

    /**
     * client guzzle
     */
    private Client $client;

    /**
     * @var array<mixed>
     */
    private array $customer;

    /**
     * @var array<mixed>
     */
    private array $items = [];

    /**
     * @var array<mixed>
     */
    private array $queryParams = [];

    /**
     * @var array<mixed>
     */
    private array $configuration = [];

    /**
     * construct
     *
     * @param array<string> $token
     * @param array<mixed> $charge
     * @param bool $sandbox
     */
    public function __construct(
        array $token,
        private array $charge = [],
        private bool $sandbox = true,
    ) {
        $this->client = $this->clientEfiBoot(
            $token['access_token'],
            $token['token_type']
        );

        if (!empty($charge)) {
            $this->charge = $charge;
        }
    }

    /**
     * set customer
     *
     * @param array<mixed> $customer
     * @return Charge
     */
    public function setCustomer(array $customer): Charge
    {
        $this->customer = $this->bootCustomer($customer);

        return $this;
    }

    /**
     * set filters
     *
     * @param array<mixed> $queryParams
     * @return ChargeInterface
     */
    public function setQueryParams(array $queryParams): ChargeInterface
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    /**
     * find all charges
     *
     * @return array<array|mixed>
     */
    public function getAll(): array
    {
        return $this->get('v1/charges', $this->queryParams);
    }

    /**
     * find charge by id
     *
     * @return array<array|mixed>
     */
    public function find(string $id): array
    {
        return $this->get("v1/charge/{$id}");
    }

    /**
     * create charge
     *
     * @return array<mixed>
     * @see fields available in https://docs.Efi.com/reference/criar-nova-cobranca
     */
    public function create(): array
    {
        // EfiChargeRequest::validate($this->charge);

        $items          = $this->getItems();
        $configurations = $this->getConfigurations();

        return $this->post('v1/charge/one-step', [
            'items'   => $items,
            'payment' => [
                'banking_billet' => [
                    'expire_at'      => $this->charge['expire_at'],
                    'customer'       => $this->customer,
                    'configurations' => $configurations,
                ],
            ],
        ]);
    }

    /**
     * update charge
     *
     * @param string $id
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function update(string $id, array $data): array
    {
        return $this->put("payments/{$id}", $data);
    }

    /**
     * cancel charge
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function cancel(string $id): array
    {
        return $this->put("v1/charge/{$id}/cancel", []);
    }

    /**
     * update due date
     *
     * @param string $id
     * @param array<array|mixed> $data
     * @return array<array|mixed>
     */
    public function updateDueDate(string $id, array $data): array
    {
        return $this->put("v1/charge/{$id}/billet", $data);
    }

    /**
     * get status charge
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function getStatus(string $id): array
    {
        return $this->get("payments/{$id}/status");
    }

    /**
     * confirm receipt
     *
     * @param string $id
     * @return array<mixed>
     */
    public function confirmReceipt(string $id): array
    {
        return $this->put("v1/charge/{$id}/settle", []);
    }

    /**
     * get items
     *
     * @return array<mixed>
     */
    private function getItems(): array
    {
        $items = $this->items;

        if (empty($this->items)) {
            $items[] = [
                'name'  => $this->charge['description'],
                'value' => $this->charge['value'],
            ];

            unset($this->charge['description']);
            unset($this->charge['value']);
        }

        return $items;
    }

    /**
     * get configuration
     *
     * @return array<mixed>
     */
    private function getConfigurations(): array
    {
        $configurations = $this->configuration;

        if (empty($configurations)) {
            $configurations = [
                'fine'     => 200,
                'interest' => 33,
            ];
        }

        return $configurations;
    }

    /**
     * boot customer
     *
     * @param array<mixed|array> $customer
     * @return array<mixed>
     */
    private function bootCustomer(array $customer): array
    {
        if (!isset($customer['name'])) {
            throw new \Exception('Efí: Nome é obrigatório');
        }

        if (!isset($customer['cpf_cnpj'])) {
            throw new \Exception('Efí: CPF/CNPJ é obrigatório');
        }

        $isFiscalPerson = (strlen($customer['cpf_cnpj']) === 11);

        if ($isFiscalPerson) {
            $customerMounted = [
                'name' => $customer['name'],
                'cpf'  => $customer['cpf_cnpj'],
            ];
        } else {
            $customerMounted = [
                'juridical_person' => [
                    'corporate_name' => $customer['name'],
                    'cnpj'           => $customer['cpf_cnpj'],
                ],
            ];
        }

        if (array_key_exists('email', $customer)) {
            $customerMounted['email'] = $customer['email'];
        }

        if (array_key_exists('phone_number', $customer)) {
            $customerMounted['phone_number'] = $customer['phone_number'];
        }

        return $customerMounted;
    }
}
