<?php

namespace Asaas\Resources\Customer\Interface;

interface CustomerInterface
{
    public function create(): string;
    public function getAll(): array;
    public function get(string $id): array;
    public function setFilter(array $filter = []): self;
}
