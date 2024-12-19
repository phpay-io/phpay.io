<?php

namespace Efi\Interface;

use Efi\Resources\Authorization\Authorization;
use PHPay\Contracts\GatewayInterface;

interface EfiGatewayInterface extends GatewayInterface
{
    public function authorization(string $clientId, string $clientSecrete): Authorization;
}
