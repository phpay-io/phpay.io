<?php

namespace PHPay\Gateways\Asaas\Resources\Interfaces;

use PHPay\Exceptions\AsaasExceptions;

interface InvoiceInterface
{
    // public function all(): self;
    // public function get(): array;
    // public function with(array $filters): self;
    // public function find(string $invoiceId): array;
    public function create(): self|AsaasExceptions;
    // public function delete(): bool;
    public function qrCodePix(): array;
}
