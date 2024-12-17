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
     * @param array $webhook
     */
    public function __construct(
        private array $webhook = [],
        private string $token,
        private bool $sandbox = true
    ) {
        $this->client = $this->clientAsaasBoot();

        if (!empty($webhook)) {
            $this->webhook = $webhook;
        }

        return $this;
    }

    /**
     * construct
     *
     * @param array $webhook
     */
    public function create(array $webhook = []): array
    {
        return $this->post('webhooks', $this->webhook);
    }

    /**
     * get all webhooks
     *
     * @param string $id
     * @return array
     */
    public function getAll(): array
    {
        return $this->get("webhooks");
    }
}
