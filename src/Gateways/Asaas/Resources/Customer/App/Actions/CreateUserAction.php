<?php

namespace Asaas\Resources\Customer\App\Actions;

use Asaas\Resoucers\Customer\Domain\Repository\CustomerRepositoryInterface;
use Asaas\Resources\Customer\Domain\Entity\Customer;

class CreateUserAction
{
    public function __construct(
        private CustomerRepositoryInterface $customerRepository
    ) {
    }

    public function execute(array $customer): void
    {
        $this->customerRepository->create(new Customer($customer));
    }
}
