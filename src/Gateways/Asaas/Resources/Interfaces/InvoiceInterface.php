<?php

namespace PHPay\Gateways\Asaas\Resources\Interfaces;

use PHPay\Exceptions\AsaasExceptions;

interface InvoiceInterface
{
    public function create(): self|AsaasExceptions;
}
