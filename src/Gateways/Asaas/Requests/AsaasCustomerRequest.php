<?php

namespace Asaas\Requests;

class AsaasCustomerRequest
{
    /**
     * validate customer
     *
     * @param array<mixed> $customer
     * @property-read string $name
     * @property-read string $cpfCnpj
     * @return void
     */
    public static function validate(array $customer): void
    {
        if (!isset($customer['name'])) {
            /** @phpstan-ignore property.notFound */
            throw new \InvalidArgumentException(self::messages()->name, 400);
        }

        if (!isset($customer['cpfCnpj'])) {
            /** @phpstan-ignore property.notFound */
            throw new \InvalidArgumentException(self::messages()->cpfCnpj, 400);
        }
    }

    /**
     * messages for validation
     *
     * @return object
     */
    public static function messages(): object
    {
        return (object) [
            'name'    => 'Asaas: Nome do cliente é obrigatório para o Asaas',
            'cpfCnpj' => 'Asaas: CPF/CNPJ do cliente é obrigatório para o Asaas',
        ];
    }
}
