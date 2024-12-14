<?php

namespace Asaas\Resoucers\Customer\Domain\Repository;

use Asaas\Resources\Customer\Domain\Entity\Customer;

interface CustomerRepositoryInterface
{
    public function create(Customer $customer): void;
}
