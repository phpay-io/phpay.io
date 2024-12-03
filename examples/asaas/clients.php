<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$client = [
    'name'     => NAME,
    'cpf_cnpj' => CPF_CNPJ,
];

/**
 * initialize phpay
 *
 * @return AsaasGateway
 */
$phpay = PHPay::asaas(TOKEN_ASAAS_SANDBOX);

/**
 *  store asaas cliente
 *
 * @param array $client <name, cpf_cnpj>
 * @return string cliente id asaas
 */
$phpay->client($client);

/**
 *  list all clients with filters
 *
 * @return array clients
 */
$response = $phpay
    ->client()
    ->with(['cpfCnpj' => '09102295466', ])
    ->all();

print_r($response);

/**
 * get client by cpf_cnpj
 *
 * @param array $client <cpf_cnpj>
 * @return array client
 */
$response = $phpay
    ->client()
    ->with(['cpfCnpj' => '09102295466'])
    ->get();

print_r($response);

/**
 * delete cliente no asaas
 *
 * @param array $client <cpf_cnpj>
 * @return bool
 */
$phpay
    ->client($client, false)
    ->delete();

/**
 * restore cliente no asaas
 */
$response = $phpay
    ->client()
    ->restore('cus_000006376400');

print_r($response);

/**
 * notifications cliente no asaas
 */
$response = $phpay
    ->client()
    ->notifications('cus_000006376400');

print_r($response);
