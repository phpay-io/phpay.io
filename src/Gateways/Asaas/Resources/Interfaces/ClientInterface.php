<?php

namespace Payhub\Gateways\Asaas\Resources\Interfaces;

use Payhub\Exceptions\AsaasExceptions;

interface ClientInterface
{
    public function all(): array;
    public function get(): array;
    public function find(string $cpfCnpj): array;
    public function with(array $filters): self;
    public function store(): string|AsaasExceptions;
    public function delete(): bool;
    public function restore(): bool;
}
