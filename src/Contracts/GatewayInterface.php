<?php

namespace Payhub\Contracts;

use Exception;

interface GatewayInterface
{
    public function auth(array $credentials, bool $sandbox = true): object;
    public function client(): object;
    public function pix(array $pix): self|Exception;
}
