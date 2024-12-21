<?php

namespace Efi\Resources\Charge\Interface;

use Efi\Resources\Charge\Charge;

interface ChargeInterface
{
    /**
     * set customer
     *
     * @param array<mixed> $customer
     * @return Charge
     */
    public function setCustomer(array $customer): Charge;
}
