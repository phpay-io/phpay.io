<?php

namespace PHPay\Gateways\Asaas;

use Illuminate\Support\Facades\Http;
use PHPay\Contracts\GatewayInterface;
use PHPay\Exceptions\AsaasExceptions;
use PHPay\Gateways\Asaas\Enums\{BillingType, ClientMethods};
use PHPay\Gateways\Asaas\Requests\AsaasPixRequest;
use PHPay\Gateways\Asaas\Resources\{Auth, Client};
use PHPay\Gateways\Gateway;

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
