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
$assas = new AsaasGateway(TOKEN_ASAAS_SANDBOX);
$phpay = PHPay::getInstance($assas)
    ->getGateway();

/**
 *  store asaas customer
 *
 * @param array $customer <name, cpfCnpj>
 * @return string customer id asaas
 */
$customerId = $phpay
    ->customer($customer)
    ->create();

print_r($customerId);

/**
 *  list all clients with filters
 *
 * @return array clients
 */
$response = $phpay
    ->customer()
    ->getAll();

print_r($response);

/**
 * get client by cpf_cnpj
 *
 * @param array $client <cpf_cnpj>
 * @return array client
 */
// $response = $phpay
//     ->client()
//     ->with(['cpfCnpj' => '09102295466'])
//     ->get();

// print_r($response);

/**
 * delete cliente no asaas
 *
 * @param array $client <cpf_cnpj>
 * @return bool
 */
// $phpay
//     ->client($client, false)
//     ->delete();

/**
 * restore cliente no asaas
 */
// $response = $phpay
//     ->client()
//     ->restore('cus_000006376400');

// print_r($response);

/**
 * notifications cliente no asaas
 */
// $response = $phpay
//     ->client()
//     ->notifications('cus_000006376400');

// print_r($response);
