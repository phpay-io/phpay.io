<?php

namespace Asaas\Resources\Customer\Interface;

interface CustomerInterface
{
    public function find(string $id): array;
    public function getAll(): array;
    public function create(): array;
    public function update(string $id): array;
    public function destroy(string $id): bool;
    public function restore(string $id): array;
    public function getNotifications(string $id): array;
    public function setFilter(array $filter = []): self;
}
