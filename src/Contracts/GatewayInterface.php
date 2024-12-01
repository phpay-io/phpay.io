<?php

namespace Payhub\Contracts;

interface GatewayInterface
{
    public function __construct(string $token, bool $sandbox = true);
    public function client(array $client): object;
}
