<?php

namespace PHPay\Gateways\Asaas\Requests;

class AsaasPixRequest
{
    /**
     * validate pix
     *
     * @param array<mixed> $pix
     * @return void
     */
    public static function validate(array $pix): void
    {
        if (!isset($pix['description'])) {
            /** @phpstan-ignore property.notFound */
            throw new \InvalidArgumentException(self::messages()->description);
        }

        if (!isset($pix['amount'])) {
            /** @phpstan-ignore property.notFound */
            throw new \InvalidArgumentException(self::messages()->amount);
        }

        if (!isset($pix['due_date'])) {
            /** @phpstan-ignore property.notFound */
            throw new \InvalidArgumentException(self::messages()->due_date->required);
        }

        if ($pix['due_date'] < date('Y-m-d')) {
            /** @phpstan-ignore property.notFound */
            throw new \InvalidArgumentException(self::messages()->due_date->date);
        }
    }

    public static function messages(): object
    {
        return (object) [
            'description' => 'Asaas: Descrição do pagamento é obrigatório para o Asaas',
            'amount'      => 'Asaas: Valor do pagamento é obrigatório para o Asaas',
            'due_date'    => (object) [
                'required' => 'Asaas: Data de vencimento do pagamento é obrigatório para o Asaas',
                'date'     => 'Asaas: Data de vencimento do pagamento não pode ser menor que a data atual',
            ],
        ];
    }
}
