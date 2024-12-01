<?php

namespace Payhub\Gateways\Asaas\Resources\Interfaces;

interface ClientInterface
{
    public function all(): array;
    public function get(): array;
    public function with(array $filter): self;
    public function store(): string;
    public function delete(): bool;
}
