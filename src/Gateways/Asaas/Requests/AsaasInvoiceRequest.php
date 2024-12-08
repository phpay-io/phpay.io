<?php

namespace PHPay\Gateways\Asaas\Requests;

use PHPay\Gateways\Asaas\Enums\{BillingTypeEnum};
use stdClass;

class AsaasInvoiceRequest
{
    /**
     * validate client and invoice data
     *
     * @param array $client
     * @param array $invoice
     * @return void
     */
    public static function validate(array $client, array $invoice): void
    {
        if (!isset($client['id'])) {
            throw new \InvalidArgumentException(self::messages()->client->id);
        }

        if (!isset($invoice['customer']) && !is_string($invoice['customer'])) {
            throw new \InvalidArgumentException(self::messages()->invoice->customer);
        }

        if (!isset($invoice['billingType'])) {
            throw new \InvalidArgumentException(self::messages()->invoice->billingType);
        }

        if (!BillingTypeEnum::tryFrom($invoice['billingType'])) {
            throw new \InvalidArgumentException(self::messages()->invoice->billingType);
        }

        if (!isset($invoice['value']) && !is_numeric($invoice['value'])) {
            throw new \InvalidArgumentException(self::messages()->invoice->value);
        }

        if (!isset($invoice['dueDate']) && !is_string($invoice['dueDate'])) {
            throw new \InvalidArgumentException(self::messages()->invoice->dueDate);
        }
    }

    /**
     * messages for validation
     *
     * @return stdClass
     */
    public static function messages(): stdClass
    {
        return (object) [
            'client' => (object) [
                'id' => 'Asaas: Para gerar uma cobrança é necessário um id de cliente do Asaas.',
            ],
            'invoice' => (object) [
                'customer'    => 'Asaas: O campo customer é obrigatório e deve ser do tipo string.',
                'billingType' => 'Asaas: O campo billingType é obrigatório, e tem como disponível as seguintes opções: UNDEFINED, BOLETO, CREDIT_CARD, PIX',
                'value'       => 'Asaas: O campo value é obrigatório e deve ser do tipo numérico.',
                'dueDate'     => 'Asaas: O campo dueDate é obrigatório e deve ser do tipo string.',
            ],
        ];
    }
}
