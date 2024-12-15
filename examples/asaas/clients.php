<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'    => 'Mário Lucas',
    'cpfCnpj' => '09102295466',
];

/**
 * initialize phpay
 */
$phpay = PHPay::getInstance(new AsaasGateway(TOKEN_ASAAS_SANDBOX))
    ->getGateway();

/**
 *  store asaas customer
 *
 * @param array $customer <name, cpfCnpj>
 * @return string customer id
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
 * @return array customers
 */
$customersFiltred = $phpay
    ->customer()
    ->setFilter([
        'cpfCnpj' => '09102295466',
    ])
    ->getAll();

/**
 * get customer by id
 *
 * @return array customer
 */
$customerById = $phpay
    ->customer()
    ->get('cus_000006399159');

/**
 * delete cliente no asaas
 *
 * @return bool
 */
$customerDeleted = $phpay
    ->customer()
    ->delete('cus_000006399159');

/**
 * restore customer deleted
 *
 * @return bool
 */
$customerRestored = $phpay
    ->customer()
    ->restore('cus_000006376400');

/**
 * customer notifications
 */
$notifications = $phpay
    ->customer()
    ->getNotifications('cus_000006376400');

print_r($notifications);
