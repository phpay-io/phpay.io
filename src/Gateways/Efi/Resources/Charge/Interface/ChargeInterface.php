<?php

namespace Efi\Resources\Charge\Interface;

use Efi\Resources\Charge\Charge;

interface ChargeInterface
{
    /**
     * get all charges
     *
     * @return array<array|mixed>
     */
    public function getAll(): array;

    /**
     * set customer
     *
     * @param array<mixed> $customer
     * @return Charge
     */
    public function setCustomer(array $customer): Charge;

    /**
     * set query params
     *
     * @param array<mixed> $queryParams
     * @return ChargeInterface
     */
    public function setQueryParams(array $queryParams): ChargeInterface;
}
