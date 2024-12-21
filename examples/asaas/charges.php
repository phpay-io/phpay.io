<?php

use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

$customer = [
    'name'    => NAME,
    'cpfCnpj' => CPF_CNPJ,
];

$charge = [
    'billingType' => 'PIX',
    'value'       => 100.00,
    'description' => 'Teste de fatura',
    'dueDate'     => date('Y-m-d', strtotime('+1 day')),
];

/**
 * @var AsaasGateway $phpay
 */
$phpay = new PHPay(new AsaasGateway(TOKEN_ASAAS_SANDBOX));

/**
 * create charge
 *
 * @return array charges
 */
$chargeCreated = $phpay
    ->charge($charge)
    ->setCustomer($customer)
    ->create();

/**
 * get all charges
 *
 * @return array charges
 */
$phpay
    ->charge()
    ->find($chargeCreated['id']);

/**
 * get all charges
 *
 * @return array charges
 */
$phpay
    ->charge()
    ->getAll();

/**
 * update charge
 *
 * @return array charge
 */
$phpay
    ->charge()
    ->update($chargeCreated['id'], [
        'description' => 'Teste de fatura atualizado',
    ]);

/**
 * destroy charge
 *
 * @return array bool
 */
$phpay
    ->charge()
    ->destroy($chargeCreated['id']);

/**
 * restore charge
 *
 * @return array charge
 */
$phpay
    ->charge()
    ->restore($chargeCreated['id']);

/**
 * get charge status
 *
 * @return array charge status
 */
$phpay
    ->charge()
    ->getStatus($chargeCreated['id']);

/**
 * get digitable line charge
 *
 * @return string
 */
$phpay
    ->charge()
    ->getDigitableLine($chargeCreated['id']);

/**
 * get qrcode charge
 *
 * @return string
 */
$qrcode = $phpay
    ->charge()
    ->getQrCodePix($chargeCreated['id']);

/**
 * confirm receipt charge
 *
 * @return array charges
 */
$confirmed = $phpay
    ->charge()
    ->confirmReceipt($chargeCreated['id'], [
        'paymentDate'    => date('Y-m-d'),
        'value'          => 100.00,
        'notifyCustomer' => true,
    ]);

/**
 * undo confirm receipt
 *
 * @return array charges
 */
$phpay
    ->charge()
    ->undoConfirmReceipt($chargeCreated['id']);
