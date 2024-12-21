<?php

use PHPay\Gateways\Efi\EfiGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'     => NAME,
    'cpf_cnpj' => CPF_CNPJ,
];

$charge = [
    'value'       => 100.00,
    'description' => 'Teste de fatura',
    'expire_at'   => date('Y-m-d', strtotime('+1 day')),
    'message'     => 'Teste de mensagem',
];

/**
 * initialize phpay
 *
 * @var EfiGateway $phpay
 */
$phpay = new PHPay(new EfiGateway(CLIENT_ID, CLIENT_SECRET));

$charge = $phpay
    ->charge($charge)
    ->setCustomer($customer)
    ->create();

print_r($charge);
