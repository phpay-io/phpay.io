<?php

use Payhub\Payhub;

test('instance payhub class', function () {
    $payhub = new Payhub('token');

    expect($payhub)
        ->toBeInstanceOf(Payhub::class);
});
