<?php

use PHPay\PHPay;

test('instance payhub class', function () {
    $payhub = new PHPay('token');

    expect($payhub)
        ->toBeInstanceOf(PHPay::class);
});
