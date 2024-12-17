<?php

namespace Asaas\Resources\Webhook\Interface;

interface WebhookInterface
{
    public function create(array $webhook = []): array;
    public function getAll(): array;
}
