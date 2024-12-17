<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'    => 'Mário Lucas',
    'cpfCnpj' => '00000000000',
];

/**
 * initialize phpay
 */
$phpay = PHPay::getInstance(new AsaasGateway(TOKEN_ASAAS_SANDBOX))
    ->getGateway();

/**
 *  store asaas customer
 *
 * @param array $customer
 * @return string customer id
 * @see available fields in https://docs.asaas.com/reference/criar-novo-cliente
 */
$customerId = $phpay
    ->customer($customer)
    ->create();

/**
 *  list all clients without filters
 *
 * @return array customers
 */
$customers = $phpay
    ->customer()
    ->getAll();

/**
 * get customer with filter
 *
 * @see available fields in https://docs.asaas.com/reference/criar-novo-cliente
 * @return array customers
 */
$customersFiltred = $phpay
    ->customer()
    ->setFilter([
        'cpfCnpj' => '00000000000',
    ])
    ->getAll();

/**
 * get customer by id
 *
 * @return array customer
 */
$customerById = $phpay
    ->customer()
    ->get('cus_000000000000');

/**
 * update customer
 *
 * @return array customer
 */
$customerUpdate = $phpay
    ->customer([
        'name'    => 'Mário Lucas Updated',
        'cpfCnpj' => '00000000000',
    ])
    ->update($customerId);

/**
 * delete cliente no asaas
 *
 * @return bool
 */
$customerDeleted = $phpay
    ->customer()
    ->destroy('cus_000000000000');

/**
 * restore customer deleted
 *
 * @return bool
 */
$customerIdRestored = $phpay
    ->customer()
    ->restore('cus_000000000000');

/**
 * customer notifications
 *
 * @return array notifications
 */
$notifications = $phpay
    ->customer()
    ->getNotifications('cus_000000000000');
