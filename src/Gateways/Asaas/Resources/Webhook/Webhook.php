<?php

namespace Asaas\Resources\Webhook;

use Asaas\Resources\Webhook\Interface\WebhookInterface;
use Asaas\Traits\HasAsaasClient;
use GuzzleHttp\Client;

class Webhook implements WebhookInterface
{
    /**
     * trait with methods to interact with asaas API
     */
    use HasAsaasClient;

    /**
     * client guzzle
     */
    private Client $client;

    /**
     * construct
     *
     * @param array<mixed> $webhook
     */
    public function __construct(
        private string $token,
        private array $webhook = [],
        private bool $sandbox = true
    ) {
        $this->client = $this->clientAsaasBoot();

        if (!empty($webhook)) {
            $this->webhook = $webhook;
        }
    }

    /**
     * construct
     *
     * @param array<mixed> $webhook
     * @return array<mixed>
     */
    public function create(array $webhook = []): array
    {
        return $this->post('webhooks', $this->webhook);
    }

    /**
     * get all webhooks
     *
     * @return array<array|mixed>
     */
    public function getAll(): array
    {
        return $this->get("webhooks");
    }

    /**
     * get webhook by id
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function find(string $id): array
    {
        return $this->get("webhooks/{$id}");
    }

    /**
     * update webhook by id
     *
     * @param string $id
     * @param array<mixed> $webhook
     * @return array<mixed>
     */
    public function update(string $id, array $webhook = []): array
    {
        return $this->put("webhooks/{$id}", $webhook);
    }

    /**
     * delete webhook by id
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->delete("webhooks/{$id}");
    }
}
