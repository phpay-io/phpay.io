<?php

namespace PHPay\Gateways\Asaas\Resources\Interfaces;

use PHPay\Exceptions\AsaasExceptions;

interface InvoiceInterface
{
    public function all(): array;
    public function create(): self|AsaasExceptions;
    public function with(array $filters): self;
    public function qrCodePix(): array;
}
