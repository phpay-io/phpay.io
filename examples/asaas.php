<?php

use Payhub\Payhub;
use Payhub\Enums\Gateways;

require_once __DIR__ . '/../vendor/autoload.php';

$payhub = new Payhub('$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwOTQ5MzU6OiRhYWNoXzY0ZjVjOGZlLTljMDMtNDM0MS05MTQ3LWRjYTkxNDdmMzBkZA==');

$client = [
    'name' => 'Mário Lucas',
    'cpf_cnpj' => '09102295466',
];

$pix = [
    'description' => 'Teste de pagamento',
    'amount' => 100.00,
    'due_date' => '2024-11-17',
];

$payhub
    ->gateway(Gateways::ASAAS)
    ->client($client)
    ->pix($pix);
