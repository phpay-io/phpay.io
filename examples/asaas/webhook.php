<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'    => NAME,
    'cpfCnpj' => CPF_CNPJ,
];

$webhook = [
    'name'        => 'Webhook de Teste',
    'url'         => 'https://sixtec.com.br/webhook',
    'email'       => 'mariolucasdev@gmail.com',
    'enabled'     => true,
    'interrupted' => false,
    'apiVersion'  => 3,
    'authToken'   => '123456',
    'sendType'    => 'SEQUENTIALLY',
    'events'      => [
        'PAYMENT_CREATED',
        'PAYMENT_UPDATED',
        'PAYMENT_CONFIRMED',
        'PAYMENT_RECEIVED',
        'PAYMENT_OVERDUE',
        'PAYMENT_DELETED',
    ],
];

/**
 * initialize phpay
 */
$phpay = PHPay::getInstance(new AsaasGateway(TOKEN_ASAAS_SANDBOX))
    ->getGateway();

/**
 *  store a new webhook
 *
 * @return array
 * @see available fields in https://docs.asaas.com/reference/criar-novo-webhook
 */
$webhook = $phpay
    ->webhook($webhook)
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
    ->find($webhook['id']);

/**
 *  update a webhook
 *
 * @return array
 * @see available fields in https://docs.asaas.com/reference/atualizar-webhook-existente
 */
$webhookUpdated = $phpay
    ->webhook()
    ->update($webhook['id'], [
        'name' => 'Webhook de Teste Atualizado',
        'url'  => 'https://sixtec.com.br/webhook/atualizado',
    ]);

/**
 *  delete a webhook
 *
 * @return bool
 */
$webhookDeleted = $phpay
    ->webhook()
    ->destroy($webhook['id']);
