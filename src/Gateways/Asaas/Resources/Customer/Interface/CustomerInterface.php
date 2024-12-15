<?php

namespace Asaas\Resources\Customer\Interface;

interface CustomerInterface
{
    public function create(): string;
    public function getAll(): array;
}
