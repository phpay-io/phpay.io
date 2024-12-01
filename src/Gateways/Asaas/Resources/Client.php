<?php

namespace Payhub\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Requests\AsaasClientRequest;

class Client
{
    /**
     * @var string
     */
    public string $clientId;

    /**
     * Client constructor.
     */
    public function __construct()
    {
    }

    /**
     * store client
     *
     * @param array $client
     * @return $this
     */
    public function store(array $client): self
    {
        AsaasClientRequest::validate($client);

        try {
            $clientExists = (object) Http::asaas()
                ->get('/customers', [
                    'cpfCnpj' => $client['cpf_cnpj'],
                ])->json();

            if (empty($clientExists->data)) {
                $client = Http::asaas()
                    ->post('/customers', [
                        'name' => $client['name'],
                        'cpfCnpj' => $client['cpf_cnpj'],
                    ])->json();

                $this->clientId = $client['id'];

                return $this;
            }

            $this->clientId = $clientExists->data[0]['id'];

            return $this;
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }
}
