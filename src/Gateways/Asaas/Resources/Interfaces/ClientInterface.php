<?php

namespace PHPay\Gateways\Asaas\Resources\Interfaces;

use PHPay\Exceptions\AsaasExceptions;

interface ClientInterface
{
    public function all(): array;
    public function get(): array;
    public function find(string $cpfCnpj): array;
    public function with(array $filters): self;
    public function store(): string|AsaasExceptions;
    public function delete(): bool;
    public function restore(string $id): bool;
    public function notifications(string $id): ?array;
}
