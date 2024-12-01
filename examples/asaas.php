<?php

use Payhub\Payhub;
use Payhub\Enums\Gateways;

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

/* instance singleton */
$payhub = (new Payhub())
    ->gateway(Gateways::ASAAS)
    ->auth($credentials, sandbox: true)
    ->client()
    ->store($client);

// TODO: create feature to extend resources
// TODO: command with stubs to create resources
