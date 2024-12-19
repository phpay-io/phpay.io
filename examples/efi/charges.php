<?php

use PHPay\Gateways\Efi\EfiGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'    => NAME,
    'cpfCnpj' => CPF_CNPJ,
];

$charge = [
    'billingType' => 'PIX',
    'value'       => 100.00,
    'description' => 'Teste de fatura',
    'dueDate'     => date('Y-m-d', strtotime('+1 day')),
];

/**
 * initialize phpay
 *
 * @var EfiGateway $phpay
 */
$phpay = new PHPay(new EfiGateway());

$token = $phpay
    ->authorization(CLIENT_ID, CLIENT_SECRET)
    ->getToken();

print_r($token);

die();

/**
 * create charge
 *
 * @return array charges
 */
$chargeCreated = $phpay
    ->charge($charge)
    ->setCustomer($customer)
    ->create();
