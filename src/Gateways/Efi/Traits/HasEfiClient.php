<?php

namespace Efi\Traits;

use GuzzleHttp\Client;

trait HasEfiClient
{
    /**
     * client guzzle
     *
     * @param string $clientId
     * @param string $clientSecret
     * @return Client
     */
    protected function clientEfiAuthorize(
        string $clientId,
        string $clientSecret
    ): Client {
        $baseUrl = $this->sandbox ?
            'https://cobrancas-h.api.efipay.com.br/' :
            'https://cobrancas.api.efipay.com.br/';

        return new Client([
            'base_uri' => $baseUrl,
            'headers'  => [
                'Authorization' => 'Basic ' . base64_encode("{$clientId}:{$clientSecret}"),
                'content-type'  => 'application/json',
            ],
        ]);
    }

    /**
     * boot client
     *
     * @param string $token
     * @param string $type
     * @return Client
     */
    protected function clientEfiBoot(string $token, string $type): Client
    {
        $baseUrl = $this->sandbox ?
            'https://cobrancas-h.api.efipay.com.br/' :
            'https://cobrancas.api.efipay.com.br/';

        return new Client([
            'base_uri' => $baseUrl,
            'headers'  => [
                'Authorization' => "{$type} {$token}",
                'content-type'  => 'application/json',
            ],
        ]);
    }

    /**
     * get data
     *
     * @param string $endpoint
     * @param array<mixed> $filters
     * @return array<array|mixed>
     */
    protected function get(string $endpoint, array $filters = []): array
    {
        try {
            $reposonse = $this->client->get($endpoint, [
                'query' => $filters,
            ]);

            $content = $reposonse
                ->getBody()
                ->getContents();

            return (array) json_decode($content, true);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * post data
     *
     * @param string $endpoint
     * @param array<mixed> $data
     * @return array<iterable|mixed>
     */
    protected function post(string $endpoint, array $data = []): array
    {
        try {
            $reposonse = $this->client->post($endpoint, [
                'json' => $data,
            ]);

            $content = $reposonse
                ->getBody()
                ->getContents();

            return (array) json_decode($content, true);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * put data
     *
     * @param string $endpoint
     * @param array<mixed> $data
     * @return array<mixed>
     */
    protected function put(string $endpoint, array $data): array
    {
        try {
            $response = $this->client->put($endpoint, [
                'json' => $data,
            ]);

            $content = $response
                ->getBody()
                ->getContents();

            return (array) json_decode($content, true);
        } catch (\Exception $e) {
            return [
                'error'   => $e->getCode(),
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * delete data
     *
     * @param string $endpoint
     * @return bool
     */
    protected function delete(string $endpoint): bool
    {
        try {
            $response = $this->client->delete($endpoint);

            return ($response->getStatusCode() == 200);
        } catch (\Exception $e) {
            return false;
        }
    }
}
