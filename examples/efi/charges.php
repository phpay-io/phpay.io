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
 * @var EfiGateway $phpay
 */
$phpay = new PHPay(new EfiGateway(CLIENT_ID, CLIENT_SECRET));

$phpay
    ->charge($charge)
    ->setCustomer($customer)
    ->create();


/**
 * get all charges
 * @return array charges
 */
$phpay
    ->charge()
    ->setQueryParams([
        'charge_type' => 'billet',
        'begin_date' => '2024-11-01',
        'end_date' => '2024-11-30',
        'status' => 'unpaid'
    ])
    ->getAll();