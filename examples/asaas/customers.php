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
 * @return array
 * @see available fields in https://docs.asaas.com/reference/criar-novo-cliente
 */
$customerCreated = $phpay
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
    ->update($customerCreated['id']);

/**
 * delete cliente no asaas
 *
 * @return bool
 */
$customerDeleted = $phpay
    ->customer()
    ->destroy($customerCreated['id']);

/**
 * restore customer deleted
 *
 * @return bool
 */
$customerIdRestored = $phpay
    ->customer()
    ->restore($customerCreated['id']);

/**
 * customer notifications
 *
 * @return array notifications
 */
$notifications = $phpay
    ->customer()
    ->getNotifications($customerCreated['id']);
