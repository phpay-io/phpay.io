<?php

use PHPay\Asaas\AsaasGateway;
use PHPay\Asaas\Resources\Charge\Charge;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

/**
 * @var Charge $phpay
 */
$phpay = (new PHPay(new AsaasGateway(TOKEN_ASAAS_SANDBOX)))->charge();

/**
 * create charge
 */
$phpay
    ->setCharge($charge)
    ->setCustomer($customer)
    ->create();

/**
 * find charge
 */
$phpay->find($chargeId);

/**
 * get all charges
 */
$phpay->getAll();

/**
 * get all charges with filters
 */
$phpay
    ->setQueryParams(['limit' => 2])
    ->getAll();

/**
 * update charge
 */
$phpay->update($chargeId, $data);

/**
 * destroy charge
 */
$phpay->destroy($chargeId);

/**
 * restore charge
 */
$phpay->restore($chargeId);

/**
 * get status charge
 */
$phpay->getStatus($chargeId);

/**
 * get digitable line charge
 */
$phpay->getDigitableLine($chargeId);

/**
 * get qrcode charge
 */
$phpay->getQrCodePix($chargeId);

/**
 * confirm receipt charge
 */
$phpay->confirmReceipt($chargeId, [
    'paymentDate'    => date('Y-m-d'),
    'value'          => 100.00,
    'notifyCustomer' => true,
]);

/**
 * undo confirm receipt
 */
$phpay->undoConfirmReceipt($chargeId);
