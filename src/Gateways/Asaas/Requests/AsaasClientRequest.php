<?php

namespace PHPay\Gateways\Asaas\Requests;

use stdClass;

class AsaasClientRequest
{
    /**
     * validate client
     *
     * @param array $client
     * @return void
     */
    public static function validate(array $client): void
    {
        if (!isset($client['name'])) {
            throw new \InvalidArgumentException(self::messages()->name);
        }

        if (!isset($client['cpf_cnpj'])) {
            throw new \InvalidArgumentException(self::messages()->cpf_cnpj);
        }
    }

    /**
     * messages for validation
     *
     * @return stdClass
     */
    public function messages(): stdClass
    {
        return (object) [
            'name'     => 'Asaas: Nome do cliente é obrigatório para o Asaas',
            'cpf_cnpj' => 'Asaas: CPF/CNPJ do cliente é obrigatório para o Asaas',
        ];
    }
}
