<?php

namespace Payhub;

use Exception;
use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use Payhub\Contracts\GatewayInterface;
use Payhub\Enums\Gateways;

class Payhub
{
    /**
     * @var GatewayInterface
     */
    protected GatewayInterface $gateway;

    /**
     * Payhub constructor.
     *
     * @param string $token
     */
    public function __construct(
        private string $token,
        private bool $production = false
    ) {
        $container = new Container();

        Facade::setFacadeApplication($container);

        $container->singleton('http', function () {
            return new Factory();
        });

        class_alias(Http::class, 'Http');
    }

    /**
     * load Gateway class
     *
     * @param Gateways $gateway
     */
    public function gateway(Gateways $gateway): GatewayInterface|Exception
    {
        $class = "Payhub\\Gateways\\{$gateway->value}\\{$gateway->value}Gateway";

        if (! class_exists($class)) {
            return throw new \InvalidArgumentException('Gateway not found');
        }

        $this->gateway = new $class($this->token, $this->production);

        return $this->gateway;
    }
}
