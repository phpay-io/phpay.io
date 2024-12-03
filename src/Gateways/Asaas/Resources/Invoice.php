<?php

namespace PHPay\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use PHPay\Exceptions\AsaasExceptions;
use PHPay\Gateways\Asaas\Requests\AsaasInvoiceRequest;
use PHPay\Gateways\Asaas\Resources\Interfaces\InvoiceInterface;
use PHPay\Gateways\Gateway;

final class Invoice implements InvoiceInterface
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
    public array $qrcode;

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
     * @param array $invoice
     * @param Gateway $gateway
     */
    public function __construct(array $invoice, Gateway $gateway)
    {
        $this->invoice = $invoice;
        $this->gateway = $gateway;
        $this->client  = $gateway->client;
    }

    /**
     * create invoice
     *
     * @return self|AsaasExceptions
     */
    public function create(): self|AsaasExceptions
    {
        $this->invoice['customer'] = $this->gateway->client['id'];

        AsaasInvoiceRequest::validate(
            $this->client,
            $this->invoice
        );

        $this->invoice = Http::asaas()
            ->post(env('ASSAS_PAYMENTS'), $this->invoice)
            ->json();

        return $this;
    }

    /**
     * get qr code from invoice
     *
     * @return array
     */
    public function qrCodePix(): array
    {
        $this->qrcode = Http::asaas()
            ->get(str_replace('{id}', $this->invoice['id'], env('ASAAS_PAYMENT_QRCODE')))
            ->json();

        return $this->qrcode;
    }
}
