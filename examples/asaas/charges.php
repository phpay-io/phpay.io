<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'     => NAME,
    'cpf_cnpj' => CPF_CNPJ,
];

$charge = [
    'billingType' => 'BOLETO',
    'value'       => 100.00,
    'description' => 'Teste de fatura',
    'dueDate'     => date('Y-m-d', strtotime('+1 day')),
];

/**
 * initialize phpay
 */
$phpay = PHPay::getInstance(new AsaasGateway(TOKEN_ASAAS_SANDBOX))
    ->getGateway();

/**
 * create charge
 *
 * @return array charges
 */
$customerId = $phpay
    ->customer($customer)
    ->create();

$charge = $phpay
    ->charge($charge)
    ->setCustomer($customerId)
    ->create();

print_r($charges);
