<?php

namespace Payhub\Gateways\Asaas;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use Payhub\Contracts\GatewayInterface;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Requests\AsaasClientRequest;
use Payhub\Gateways\Asaas\Requests\AsaasPixRequest;

class AsaasGateway implements GatewayInterface
{
    /**
     * @var string
     */
    protected string $client;

    /**
     * AsaasGateway constructor.
     */
    public function __construct(
        private string $token,
        private bool $production
    ) {
        $baseUrl = $this->production ?
                'https://api.asaas.com/v3' :
                'https://sandbox.asaas.com/api/v3';

        Http::macro('asaas', function () use ($token, $baseUrl) {
            return Http::acceptJson()
                ->baseUrl($baseUrl)
                ->withHeaders([
                    'content-type' => 'application/json',
                    'user-agent' => 'payhub',
                    'access_token' => $token,
                ]);
        });
    }

    /**
     * set client
     *
     * @param array $client
     */
    public function client(array $client): self
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

                $this->client = $client['id'];

                return $this;
            }

            $this->client = $clientExists->data[0]['id'];

            return $this;
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }

    /**
     * set pix
     *
     * @param array $pix
     */
    public function pix(array $pix): self
    {
        try {
            AsaasPixRequest::validate($pix);

            $pix = Http::asaas()
                ->post('/payments', [
                    'customer' => $this->client,
                    'billingType' => 'BOLETO',
                    'value' => $pix['amount'],
                    'dueDate' => $pix['due_date'],
                    'description' => $pix['description'],
                ])->json();

            return $this;
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }
}
