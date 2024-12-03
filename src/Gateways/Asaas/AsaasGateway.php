<?php

namespace PHPay\Gateways\Asaas;

use Illuminate\Support\Facades\Http;
use PHPay\Contracts\GatewayInterface;
use PHPay\Exceptions\AsaasExceptions;
use PHPay\Gateways\Asaas\Enums\{BillingType};
use PHPay\Gateways\Asaas\Requests\AsaasPixRequest;
use PHPay\Gateways\Asaas\Resources\{Auth, Client, Invoice};
use PHPay\Gateways\Gateway;

class AsaasGateway extends Gateway implements GatewayInterface
{
    /**
     * @var array
     */
    public array $client;

    /**
     * @var array
     */
    public array $invoice;

    /**
     * @var array
     */
    private array $payment;

    /**
     * @var object
     */
    public object $resource;

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
     * @return Client|self
     */
    public function client(
        array $client = [],
        bool $createOnly = true
    ): Client|self {
        $clientInstance = new Client($client, $this);

        if ($createOnly && !empty($client)) {
            $this->client = $clientInstance->create()->client;

            return $this;
        }

        return $clientInstance;
    }

    /**
     * set invoice
     *
     * @param array $invoice
     * @return Invoice|self
     */
    public function invoice(
        array $invoice = [],
        bool $createOnly = true
    ): Invoice|self {
        if (!isset($this->client['id'])) {
            throw new \Exception('Para criar um fatura é necessário a criação de um cliente');
        }

        $invoice['customer'] = $this->client['id'];

        $invoiceInstance = new Invoice($invoice, $this);

        if ($createOnly && empty($invoice)) {
            $this->invoice = $invoiceInstance->create()->invoice;

            $this;
        }

        return $invoiceInstance;
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
                    'customer'    => $this->client['id'],
                    'billingType' => BillingType::PIX->value,
                    'value'       => $amount,
                    'dueDate'     => $due_date,
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
