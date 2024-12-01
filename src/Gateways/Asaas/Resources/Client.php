<?php

namespace Payhub\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Requests\AsaasClientRequest;
use Payhub\Gateways\Asaas\Resources\Interfaces\ClientInterface;
use Payhub\Gateways\Gateway;

final class Client implements ClientInterface
{
    /**
     * @var array
     */
    protected array $client;

    /**
     * @var array
     */
    protected array $filters = [];

    /**
     * @var Gateway
     */
    protected Gateway $gateway;

    /**
     * construct
     *
     * @param array $client
     * @param Gateway $gateway
     */
    public function __construct(array $client, Gateway $gateway)
    {
        $this->client = $client;
        $this->gateway = $gateway;
    }

    /**
     * get all clients
     *
     * @return array
     */
    public function all(): array
    {
        $client = Http::asaas()
            ->get(env('ASSAS_CLIENTS') . '/?' . http_build_query($this->filters))
            ->json();

        return $client;
    }

    /**
     * get client
     *
     * @return array
     */
    public function get(): array
    {
        $client = Http::asaas()
            ->get(env('ASSAS_CLIENTS') . '/?' . http_build_query($this->filters))
            ->json();

        return $client['data'][0];
    }

    /**
     * store client
     *
     * @return $this
     */
    public function store(): string
    {
        AsaasClientRequest::validate($this->client);

        try {
            extract($this->client);

            $client = self::find($cpf_cnpj);

            if (! empty($client)) {
                return  $client[0]['id'];
            }

            $client = Http::asaas()
                ->post(env('ASSAS_CLIENTS'), [
                    'name' => $name,
                    'cpfCnpj' => $cpf_cnpj,
                ])->json();

            return $client['id'];

        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }

    /**
     * check if client exists
     *
     * @param string $client
     * @return array
     */
    public static function find(string $cpfCnpj): array
    {
        $client = (object) Http::asaas()
            ->get(env('ASSAS_CLIENTS'), [
                'cpfCnpj' => $cpfCnpj,
            ])->json();

        return $client->data;
    }

    /**
     * delete client
     *
     * @return bool
     */
    public function delete(): bool
    {
        try {
            $client = self::find($this->client['cpf_cnpj']);

            if (empty($client)) {
                return false;
            }

            $client = Http::asaas()
                ->delete(env('ASSAS_CLIENTS') . '/' . $client[0]['id'])
                ->json();

            if ($client['deleted']) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            (new AsaasExceptions())($e->getMessage());

            return false;
        }
    }

    /**
     * set filters
     * to ready about filters, see
     * https://docs.asaas.com/reference/listar-clientes
     *
     * @param array $filter
     * @return $this
     */
    public function with(array $filter): self
    {
        $this->filters = $filter;

        return $this;
    }
}
