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
     * @var array<mixed>
     */
    private array $queryParams = [];

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
    * set query params
    *
    * @param array<mixed> $queryParams
    * @return PixInterface
    */
    public function setQueryParams(array $queryParams): PixInterface
    {
        $this->queryParams = $queryParams;

        return $this;
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

    /**
     * get all pix keys
     *
     * @return array<mixed>
     * @see params in https://docs.asaas.com/reference/list-keys
     */
    public function getAll(): array
    {
        $params = $this->queryParams;

        if (empty($params)) {
            $params = [
                'offset' => 0,
                'limit'  => 100,
                'status' => 'ACTIVE',
            ];
        }

        return $this->get('pix/addressKeys', $params);
    }
}
