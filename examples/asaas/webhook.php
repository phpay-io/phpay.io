<?php

use PHPay\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'    => NAME,
    'cpfCnpj' => CPF_CNPJ,
];

/**
 * initialize phpay
 *
 * @var AsaasGateway $phpay
 */
$phpay = new PHPay(new AsaasGateway(TOKEN_ASAAS_SANDBOX));

/**
 *  store a new webhook
 *
 * @return array
 * @see available fields in https://docs.asaas.com/reference/criar-novo-webhook
 */
$phpay
    ->webhook(WEBHOOK)
    ->create();

/**
 *  get all webhooks
 *
 * @return array
 */
$phpay
    ->webhook()
    ->getAll();

/**
 *  find a webhook
 *
 * @return array
 */
$phpay
    ->webhook()
    ->find($webhookId);

/**
 *  update a webhook
 *
 * @return array
 * @see available fields in https://docs.asaas.com/reference/atualizar-webhook-existente
 */
$phpay
    ->webhook()
    ->update($webhookId, [
        'name' => 'Update webhook with PHPay is awesome',
        'url'  => 'https://sixtec.com.br/webhook/atualizado',
    ]);

/**
 *  delete a webhook
 *
 * @return bool
 */
$phpay
    ->webhook()
    ->destroy($webhookId);
