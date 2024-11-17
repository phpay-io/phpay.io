<?php

namespace Payhub\Gateways\Asaas\Requests;

use stdClass;

class AsaasClientRequest
{
    public static function validate(array $client): void
    {
        if (! isset($client['name'])) {
            throw new \InvalidArgumentException(self::messages()->name);
        }

        if (! isset($client['cpf_cnpj'])) {
            throw new \InvalidArgumentException(self::messages()->cpf_cnpj);
        }
    }

    public function messages(): stdClass
    {
        return (object) [
            'name' => 'Asaas: Nome do cliente é obrigatório para o Asaas',
            'cpf_cnpj' => 'Asaas: CPF/CNPJ do cliente é obrigatório para o Asaas',
        ];
    }
}
