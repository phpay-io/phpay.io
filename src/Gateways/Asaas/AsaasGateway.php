<?php

namespace Payhub\Gateways\Asaas;

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

    public function authorize(array $credentials, bool $sandbox = true): self
    {
        $baseUrl = $sandbox ?
                'https://sandbox.asaas.com/api/v3' :
                'https://api.asaas.com/v3';

        extract($credentials);

        if (! isset($token)) {
            return (new AsaasExceptions())('As credenciais do asaas precisam de um parâmetro token.');
        }

        Http::macro('asaas', function () use ($token, $baseUrl) {
            return Http::acceptJson()
                ->baseUrl($baseUrl)
                ->withHeaders([
                    'content-type' => 'application/json',
                    'user-agent' => 'payhub',
                    'access_token' => $token,
                ]);
        });

        return $this;
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

            print_r($pix);

            return $this;
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }
}
