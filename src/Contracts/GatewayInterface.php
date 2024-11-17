<?php

namespace Payhub\Contracts;

use Exception;

interface GatewayInterface
{
    public function __construct(string $token, bool $production);

    public function client(array $client): self|Exception;

    public function pix(array $pix): self|Exception;
}
