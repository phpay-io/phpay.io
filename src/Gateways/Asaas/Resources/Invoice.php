<?php

namespace PHPay\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use PHPay\Exceptions\AsaasExceptions;
use PHPay\Gateways\Asaas\Enums\InvoiceFiltersEnum;
use PHPay\Gateways\Asaas\Requests\AsaasInvoiceRequest;
use PHPay\Gateways\Asaas\Resources\Interfaces\InvoiceInterface;
use PHPay\Gateways\Gateway;

final class Invoice implements InvoiceInterface
{
    /**
     * construct
     *
     * @param array $invoice
     * @param Gateway $gateway
     */
    public function __construct(
        public array $invoice,
        protected Gateway $gateway,
        public array $client = [],
        public array $qrcode = [],
        public array $filters = [],
        public array $invoices = [],
    ) {
        $this->invoice = $invoice;
        $this->gateway = $gateway;
        $this->client  = $gateway->client;
    }

    /**
     * get all invoices
     *
     * @return array
     */
    public function all(): array
    {
        $invoices = Http::asaas()
            ->get(env('ASSAS_PAYMENTS') . '/?' . http_build_query($this->filters))
            ->json();

        $this->invoices = $invoices['data'];

        return $this->invoices;
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

        $invoice = Http::asaas()
            ->post(env('ASSAS_PAYMENTS'), $this->invoice)
            ->json();

        $this->invoice = $invoice;

        return $this;
    }

    /**
     * set filters
     *
     *
     * @param array $filters
     * @return self
     * @throws AsaasExceptions
     * @see PHPay\Gateways\Asaas\Enums\InvoiceFiltersEnum
     */
    public function with(array $filters): self
    {
        foreach ($filters as $key => $value) {
            if (!in_array($key, InvoiceFiltersEnum::cases())) {
                throw new AsaasExceptions('filter not found' . $key . ' not found');
            }
        }

        $this->filters = $filters;

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
