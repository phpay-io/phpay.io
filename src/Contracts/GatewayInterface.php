<?php

namespace Payhub\Contracts;

interface GatewayInterface
{
    public function __construct(array $credentials, bool $sandbox = true);
    public function client(array $client): object;
    public function pix(array $pix): object;
}
