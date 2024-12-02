<?php

use PHPay\PHPay;

test('instance payhub class', function () {
    $token = '';

    $phpay = PHPay::asaas($token);

    expect($phpay)
        ->toBeInstanceOf(PHPay::class);
});
