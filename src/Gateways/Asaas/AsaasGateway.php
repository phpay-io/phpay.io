<?php

namespace Payhub\Gateways\Asaas;

use Illuminate\Support\Facades\Http;
use Payhub\Contracts\GatewayInterface;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Enums\{BillingType, ClientMethods};
use Payhub\Gateways\Asaas\Requests\AsaasPixRequest;
use Payhub\Gateways\Asaas\Resources\{Auth, Client};
use Payhub\Gateways\Gateway;

class AsaasGateway extends Gateway implements GatewayInterface
{
    /**
     * @var string
     */
    private string $customerId;

    /**
     * @var array
     */
    private array $payment;

    /**
     * construct
     *
     * @param string $token
     * @param bool $sandbox
     */
    public function __construct(string $token, bool $sandbox = true)
    {
        new Auth($token, $sandbox);
    }

    /**
     * set client
     *
     * @param array $client
     * @return Client
     */
    public function client(array $client = []): Client
    {
        return new Client($client, $this);
    }
    // {
    //     if (! ClientMethods::tryFrom($method)) {
    //         return (new AsaasExceptions())('Method not found');
    //     }

    //     if (! method_exists(Client::class, $method)) {
    //         return (new AsaasExceptions())('Method not found');
    //     }

    //     try {
    //         $this->customerId = (new Client())::$method($client);
    //     } catch (\Exception $e) {
    //         return (new AsaasExceptions())($e->getMessage());
    //     }

    //     return $this;
    // }

    /**
     * generate pix
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
                    'customer' => $this->customerId,
                    'billingType' => BillingType::PIX->value,
                    'value' => $amount,
                    'dueDate' => $due_date,
                    'description' => $description,
                ])->json();

            $this->payment = $payment;

            echo 'Pix gerado com sucesso' . PHP_EOL;
            echo 'Pix: ' . $this->payment['id'] . PHP_EOL;

        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }

        return $this;
    }
}
