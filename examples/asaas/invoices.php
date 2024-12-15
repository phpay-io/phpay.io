<?php

use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$client = [
    'name'     => NAME,
    'cpf_cnpj' => CPF_CNPJ,
];

$invoice = [
    'billingType' => 'BOLETO',
    'value'       => 100.00,
    'description' => 'Teste de fatura',
    'dueDate'     => date('Y-m-d', strtotime('+1 day')),
];

$assas = PHPay::asaas(TOKEN_ASAAS_SANDBOX);

$invoices = $assas
    ->invoice(createOnly: false)
    ->with([])
    ->all();

print_r($invoices);

$qrcode = $assas
    ->client($client)
    ->invoice($invoice, false)
    ->qrCodePix();

print_r($qrcode);
