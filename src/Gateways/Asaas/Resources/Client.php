<?php

namespace Payhub\Gateways\Asaas\Resources;

use Illuminate\Support\Facades\Http;
use Payhub\Exceptions\AsaasExceptions;
use Payhub\Gateways\Asaas\Requests\AsaasClientRequest;

final class Client
{
    /**
     * store client
     *
     * @param array $client
     * @return $this
     */
    public static function store(array $client): string
    {
        AsaasClientRequest::validate($client);

        try {

            extract($client);

            $client = self::find($cpf_cnpj);

            if (! empty($client)) {
                return  $client[0]['id'];
            }

            $client = Http::asaas()
                ->post(env('ASSAS_CLIENTS'), [
                    'name' => $name,
                    'cpfCnpj' => $cpf_cnpj,
                ])->json();

            return $client['id'];

        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }

    /**
     * check if client exists
     *
     * @param string $client
     * @return array
     */
    public static function find(string $cpfCnpj): array
    {
        $client = (object) Http::asaas()
            ->get(env('ASSAS_CLIENTS'), [
                'cpfCnpj' => $cpfCnpj,
            ])->json();

        return $client->data;
    }

    /**
     * update client
     *
     * @param array $client
     * @return string
     */
    public static function delete(array $client): string
    {
        try {
            $client = self::find($client['cpf_cnpj']);

            if (empty($client)) {
                return 'Client not found';
            }

            $client = Http::asaas()
                ->delete(env('ASSAS_CLIENTS') . '/' . $client[0]['id'])
                ->json();

            echo 'Client deleted';

            return $client['id'];

        } catch (\Exception $e) {
            return (new AsaasExceptions())($e->getMessage());
        }
    }
}
