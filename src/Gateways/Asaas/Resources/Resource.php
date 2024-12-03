<?php

namespace PHPay\Gateways\Asaas\Resources;

use PHPay\Gateways\Asaas\AsaasGateway;

class Resource
{
    /**
     * @var AsaasGateway
     */
    public AsaasGateway $parentGateway;

    /**
     * set parent gateway
     *
     * @param AsaasGateway $gateway
     * @return void
     */
    public function setParent(AsaasGateway $gateway): void
    {
        $this->parentGateway = $gateway;
    }

    /**
     * set resource data
     *
     * @return AsaasGateway
     */
    public function back(): AsaasGateway
    {
        $this->parentGateway->setResource($this);

        return $this->parentGateway;
    }
}
