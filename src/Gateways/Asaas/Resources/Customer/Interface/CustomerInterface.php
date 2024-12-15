<?php

namespace Asaas\Resources\Customer\Interface;

interface CustomerInterface
{
    public function get(string $id): array;
    public function getAll(): array;
    public function create(): string;
    public function delete(string $id): bool;
    public function restore(string $id): bool;
    public function setFilter(array $filter = []): self;
}
