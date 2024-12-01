<?php

namespace Payhub\Gateways\Asaas;

use Illuminate\Support\Facades\Http;
use Payhub\Contracts\GatewayInterface;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Requests\AsaasPixRequest;
use Payhub\Gateways\Asaas\Resources\Auth;
use Payhub\Gateways\Asaas\Resources\Client;

class AsaasGateway implements GatewayInterface
{
    /**
     * @var array
     */
    protected array $client;

    /**
     * auth
     *
     * @param array $credentials
     * @param bool $sandbox
     * @return $this
     */
    public function auth(array $credentials, bool $sandbox = true): self
    {
        (new Auth())($credentials, $sandbox);

        return $this;
    }

    /**
     * set client
     *
     * @param array $client
     * @return Client
     */
    public function client(): Client
    {
        return new Client();
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
