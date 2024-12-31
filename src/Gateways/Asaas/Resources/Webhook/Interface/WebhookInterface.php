<?php

namespace PHPay\Asaas\Resources\Webhook\Interface;

interface WebhookInterface
{
    /**
     * create webhook
     *
     * @param array<mixed> $webhook
     * @return array<mixed>
     */
    public function create(array $webhook = []): array;

    /**
     * get all webhooks
     *
     * @return array<array|mixed>
     */
    public function getAll(): array;

    /**
     * find webhook by id
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function find(string $id): array;

    /**
     * update webhook by id
     *
     * @param string $id
     * @param array<mixed> $webhook
     * @return array<mixed>
     */
    public function update(string $id, array $webhook = []): array;

    /**
     * delete webhook by id
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;
}
