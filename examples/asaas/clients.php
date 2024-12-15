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
 * @return string customer id asaas
 */
// $customerId = $phpay
//     ->customer($customer)
//     ->create();

// print_r($customerId);

/**
 *  list all clients without filters
 *
 * @return array clients
 */
// $customers = $phpay
//     ->customer()
//     ->getAll();

// print_r($customers);

/**
 * get customer by cpf_cnpj
 *
 * @param array $customer <cpf_cnpj>
 * @return array customer
 */
// $customersFiltred = $phpay
//     ->customer()
//     ->setFilter([
//         'cpfCnpj' => '09102295466',
//     ])
//     ->getAll();

// print_r($customersFiltred);

/**
 * get customer by id
 *
 * @param string $id
 * @return array customer
 */
// $customerById = $phpay
//     ->customer()
//     ->get('cus_000006399159');

// print_r($customerById);

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
