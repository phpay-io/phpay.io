<?php

namespace Asaas\Resources\Webhook\Interface;

interface WebhookInterface
{
    public function create(array $webhook = []): array;
    public function getAll(): array;
    public function find(string $id): array;
    public function update(string $id, array $webhook = []): array;
    public function destroy(string $id): bool;
}
