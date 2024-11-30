<?php

namespace Payhub\Contracts;

use Exception;

interface GatewayInterface
{
    public function authorize(array $credentials, bool $sandbox = true): self|Exception;

    public function client(array $client): self|Exception;

    public function pix(array $pix): self|Exception;
}
