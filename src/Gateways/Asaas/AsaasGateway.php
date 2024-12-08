<?php

namespace PHPay\Gateways\Asaas;

use Illuminate\Support\Facades\Http;
use PHPay\Contracts\GatewayInterface;
use PHPay\Exceptions\AsaasExceptions;
use PHPay\Gateways\Asaas\Enums\BillingTypeEnum;
use PHPay\Gateways\Asaas\Requests\AsaasPixRequest;
use PHPay\Gateways\Asaas\Resources\{Auth, Client, Invoice};
use PHPay\Gateways\Gateway;

class AsaasGateway extends Gateway implements GatewayInterface
{
    /**
     * construct
     *
     * @param string $token
     * @param bool $sandbox
     */
    public function __construct(
        private string $token,
        private bool $sandbox = true,
        public array $client = [],
        public array $invoice = [],
        public array $payment = [],
    ) {
        new Auth($token, $sandbox);
    }

    /**
     * set client
     *
     * @param array $client
     * @param bool $createOnly
     * @return Client|self
     */
    public function client(array $client = [], bool $createOnly = true): Client|self
    {
        $clientInstance = new Client($client, $this);

        if ($createOnly && !empty($client)) {
            $clientInstance->create();

            $this->client = $clientInstance->client;

            return $this;
        }

        return $clientInstance;
    }

    /**
     * set invoice
     *
     * @param array $invoice
     * @param bool $createOnly
     * @return Invoice|self
     */
    public function invoice(array $invoice = [], bool $createOnly = true): Invoice|self
    {
        $invoiceInstance = new Invoice($invoice, $this);

        if (!empty($invoice)) {
            $invoiceInstance->create();

            $this->invoice = $invoiceInstance->invoice;

            if ($createOnly) {
                return $this;
            }

            return $invoiceInstance;
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
                    'billingType' => BillingTypeEnum::PIX->value,
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
