<?php

use PHPay\Efi\EfiGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'     => NAME,
    'cpf_cnpj' => CPF_CNPJ,
];

$charge = [
    'value'       => 100.00,
    'description' => 'Teste de fatura',
    'expire_at'   => date('Y-m-d', strtotime('+1 day')),
    'message'     => 'Teste de mensagem',
];

/**
 * @var EfiGateway $phpay
 */
$phpay = new PHPay(new EfiGateway(CLIENT_ID, CLIENT_SECRET));

$phpay
    ->charge($charge)
    ->setCustomer($customer)
    ->create();

/**
 * get all charges
 *
 * @return array charges
 */
$charges = $phpay
    ->charge()
    ->getAll();

/**
 * find charge by id
 *
 * @return array charge
 */
$phpay
    ->charge()
    ->find($chargeId);

/**
 * confirm receipt
 *
 * @return array charge
 */
$phpay
    ->charge()
    ->confirmReceipt($chargeId);

/**
 * cancel charge
 */
$phpay
    ->charge()
    ->cancel($chargeId);

/**
 * update due date
 */
$phpay
    ->charge()
    ->updateDueDate($chargeId, $dueDate);

/**
 * update billet metadata
 * notification_url and custom_id
 */
$phpay
    ->charge()
    ->updateMetadata($chargeId, [
        'notification_url' => $notificationUrl,
        'custom_id'        => $customId,
    ]);
