<?php

namespace PHPay;

use PHPay\Contracts\GatewayInterface;

class PHPay
{
    private static ?self $instance = null;

    /**
     * private constructor prevents new instances.
     *
     * @param GatewayInterface $gateway
     */
    private function __construct(
        private GatewayInterface $gateway
    ) {
        $this->gateway = $gateway;
    }

    /**
     * get instance of PHPay.
     *
     * @param GatewayInterface $gateway
     * @return self
     */
    public static function getInstance(GatewayInterface $gateway): self
    {
        if (self::$instance === null) {
            self::$instance = new self($gateway);
        }

        return self::$instance;
    }

    /**
     * get current gateway.
     *
     * @return GatewayInterface
     */
    public function getGateway(): GatewayInterface
    {
        return $this->gateway;
    }

    /**
     * set a new gateway.
     *
     * @param GatewayInterface $gateway
     * @return void
     */
    public function setGateway(GatewayInterface $gateway): void
    {
        $this->gateway = $gateway;
    }
}
