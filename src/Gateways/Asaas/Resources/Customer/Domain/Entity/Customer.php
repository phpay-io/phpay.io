<?php

namespace Asaas\Resources\Customer\Domain\Entity;

class Customer
{
    public function __construct(array $customer)
    {
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
