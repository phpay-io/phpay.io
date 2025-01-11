<?php

use PHPay\Asaas\AsaasGateway;
use PHPay\PHPay;

require_once __DIR__ . '/../../vendor/autoload.php';

require_once __DIR__ . '/credentials.php';

/**
 * @var AsaasGateway $phpay
 */
$phpay = new PHPay(new AsaasGateway(TOKEN_ASAAS_SANDBOX));

$phpay
    ->pix()
    ->createKey();

$phpay
    ->pix()
    ->find(ID_PIX_KEY);

$phpay
    ->pix()
    ->getAll();

$phpay
    ->pix()
    ->destroy(ID_PIX_KEY);
