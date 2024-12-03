<?php

namespace PHPay\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use PHPay\Exceptions\AsaasExceptions;
use PHPay\Gateways\Asaas\Resources\Interfaces\InvoiceInterface;
use PHPay\Gateways\Gateway;

final class Invoice extends Resource implements InvoiceInterface
{
    /**
     * @var array
     */
    public array $invoice;

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
    }

    /**
     * create invoice
     *
     * @return self|AsaasExceptions
     */
    public function create(): self|AsaasExceptions
    {
        try {
            $this->invoice = Http::asaas()
                ->post(env('ASSAS_PAYMENTS'), $this->invoice)
                ->json();
        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }

        return $this;
    }
}
