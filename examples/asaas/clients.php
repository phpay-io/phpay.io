<?php

use Payhub\Payhub;
use Payhub\Gateways\Asaas\AsaasGateway;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/credentials.php';

$client = [
    'name' => '', /* client name */
    'cpf_cnpj' => '' /* valid cpf or cnpj */,
];

/**
 * initialize payhub
 *
 * @param array $credentials <token>
 * @param bool $sandbox
 *
 * @return AsaasGateway
 */
$payhub = Payhub::asaas(TOKEN_ASAAS_SANDBOX);

/**
 *  store asaas cliente
 *
 * @param array $client <name, cpf_cnpj>
 * @return string cliente id asaas
 */
$payhub
    ->client($client)
    ->store();

/**
 *  list all clients with filters
 *
 * @return array clients
 */
$response = $payhub
    ->client()
    ->with(['cpfCnpj' => '09102295466',])
    ->all();

// print_r($response);

/**
 * get client by cpf_cnpj
 *
 * @param array $client <cpf_cnpj>
 * @return array client
 */
$response = $payhub
    ->client()
    ->with(['cpfCnpj' => '09102295466'])
    ->get();

// print_r($response);

/**
 * delete cliente no asaas
 *
 * @param array $client <cpf_cnpj>
 * @return bool
 */
$payhub->client($client)
    ->delete();
