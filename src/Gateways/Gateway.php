<?php

namespace Payhub\Gateways;

abstract class Gateway
{
    abstract public function client(array $client = []): object;
}
