<?php

use Payhub\Payhub;
use Payhub\Gateways\Asaas\AsaasGateway;

require_once __DIR__ . '/../vendor/autoload.php';

$client = [
    'name' => 'Mário Lucas',
    'cpf_cnpj' => '09102295466',
];

$pix = [
    'description' => 'Teste de pagamento',
    'amount' => 100.00,
    'due_date' => date('Y-m-d'),
];

$credentials = [
    'token' => '$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTQ5MzU6OiRhYWNoXzY0ZjVjOGZlLTljMDMtNDM0MS05MTQ3LWRjYTkxNDdmMzBkZA==',
];

/**
 * initialize payhub
 *
 * @param array $credentials <token>
 * @param bool $sandbox
 *
 * @return AsaasGateway
 */
$payhub = Payhub::asaas(
    $credentials,
    sandbox: true
);

/**
 *  store asaas cliente
 *
 * @param array $client <name, cpf_cnpj>
 * @return string cliente id asaas
 */
$response = $payhub
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

/**
 * delete cliente no asaas
 *
 * @param array $client <cpf_cnpj>
 * @return bool
 */
$payhub->client($client)
    ->delete();


/* editar cliente no asaas */
// $payhub->client($client, method: 'update');


/* localizar cliente no asaas pelo documento */
// $payhub
//     ->client()
//     ->find('09102295466');


// TODO: create feature to extend resources
// TODO: command with stubs to create resources
