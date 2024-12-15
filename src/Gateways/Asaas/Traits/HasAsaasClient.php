<?php

namespace Asaas\Traits;

use GuzzleHttp\Client;

trait HasAsaasClient
{
    /**
     * boot client
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
     * @return array
     */
    public function get(string $endpoint): array
    {
        try {
            $reposonse = $this->client->get($endpoint);

            $content = $reposonse
                ->getBody()
                ->getContents();

            return json_decode($content, true);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * post data
     *
     * @param string $endpoint
     * @param array $data
     * @return string
     */
    public function post(string $endpoint, array $data): string
    {
        try {
            $reposonse = $this->client->post($endpoint, [
                'json' => $data,
            ]);

            $content = $reposonse
                ->getBody()
                ->getContents();

            $reposonses = json_decode($content, true);

            return $reposonses['id'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * put data
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     */
    public function put(string $endpoint, array $data): array
    {
        try {
            $response = $this->client->put($endpoint, [
                'json' => $data,
            ]);

            $content = $response
                ->getBody()
                ->getContents();

            return json_decode($content, true);
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
    public function delete(string $endpoint): bool
    {
        try {
            $this->client->delete($endpoint);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
