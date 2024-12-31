<?php

namespace PHPay\Asaas\Traits;

use GuzzleHttp\Client;

trait HasAsaasClient
{
    /**
     * boot client
     *
     * @return Client
     */
    protected function clientAsaasBoot(): Client
    {
        $baseUrl = $this->sandbox ?
            'https://sandbox.asaas.com/api/v3/' :
            'https://www.asaas.com/api/v3/';

        return new Client([
            'base_uri' => $baseUrl,
            'headers'  => [
                'content-type' => 'application/json',
                'user-agent'   => 'PHPay',
                'access_token' => $this->token,
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
