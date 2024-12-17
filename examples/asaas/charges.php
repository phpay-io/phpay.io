<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'     => NAME,
    'cpfCnpj' => CPF_CNPJ,
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
 * create customer
 *
 * @return array customer
 */
$customerCreated = $phpay
    ->customer($customer)
    ->create();

/**
 * create charge
 *
 * @return array charges
 */
$charges = $phpay
    ->charge($charge)
    ->setCustomer($customerCreated['id'])
    ->create();

/**
 * create charge lean
 *
 * @return array charges
 */
$chargeLean = $phpay
    ->charge($charge)
    ->setCustomer($customerCreated['id'])
    ->createLean();

/**
 * get all charges
 *
 * @return array charges
 */
$charge = $phpay
    ->charge()
    ->find($chargeLean['id']);

print_r($charge);


/**
 * get all charges
 *
 * @return array charges
 */
$charges = $phpay
    ->charge()
    ->getAll();
