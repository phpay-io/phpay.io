<?php

use PHPay\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

/**
 * @var AsaasGateway $phpay
 */
$phpay = new PHPay(new AsaasGateway(TOKEN_ASAAS_SANDBOX));

/**
 * create pix key
 *
 * @return string $pixKey
 */
$phpay
    ->pix()
    ->createKey();

/**
 * get all pix keys
 *
 * @return array $pixKeys
 */
$phpay
    ->pix()
    ->getAll();
