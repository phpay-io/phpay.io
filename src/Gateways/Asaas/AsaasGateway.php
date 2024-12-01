<?php

namespace Payhub\Gateways\Asaas;

use Illuminate\Support\Facades\Http;
use Payhub\Contracts\GatewayInterface;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Enums\{BillingType, ClientMethods};
use Payhub\Gateways\Asaas\Requests\AsaasPixRequest;
use Payhub\Gateways\Asaas\Resources\{Auth, Client};

class AsaasGateway implements GatewayInterface
{
    /**
     * @var string
     */
    private string $client;

    /**
     * @var array
     */
    private array $payment;

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
     * @return self
     */
    public function client(array $client, string $method = 'store'): self|AsaasExceptions
    {
        if (! ClientMethods::tryFrom($method)) {
            return (new AsaasExceptions())('Method not found');
        }

        if (! method_exists(Client::class, $method)) {
            return (new AsaasExceptions())('Method not found');
        }

        try {
            $this->client = (new Client())::$method($client);
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }

        return $this;
    }

    /**
     * set pix
     *
     * @param array $pix
     */
    public function pix(array $pix): self|AsaasExceptions
    {
        try {
            AsaasPixRequest::validate($pix);

            extract($pix);

            $payment = Http::asaas()
                ->post('/payments', [
                    'customer' => $this->client,
                    'billingType' => BillingType::PIX->value,
                    'value' => $amount,
                    'dueDate' => $due_date,
                    'description' => $description,
                ])->json();

            print_r($payment);

            $this->payment = $payment;
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }

        return $this;
    }
}
