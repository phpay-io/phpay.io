<?php

namespace PHPay\Asaas\Resources\Pix;

use GuzzleHttp\Client;
use PHPay\Asaas\Resources\Pix\Interface\PixInterface;
use PHPay\Asaas\Traits\HasAsaasClient;

class Pix implements PixInterface
{
    /**
     * trait asaas client
     */
    use HasAsaasClient;

    /**
     * client guzzle
     */
    private Client $client;

    /**
     * construct
     *
     * @param string $token
     */
    public function __construct(
        private string $token,
        private bool $sandbox = true,
    ) {
        $this->client = $this->clientAsaasBoot();
    }

    /**
     * create pix key
     *
     * @return string
     * @return array<mixed>
     */
    public function createKey(): array
    {
        /* TODO: prepare response */
        /* TODO: adding reponse with image qrcode */
        return $this->post('pix/addressKeys', [
            'type' => 'EVP',
        ]);
    }
}
