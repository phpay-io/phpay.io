<?php

namespace Payhub;

use Dotenv\Dotenv;
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
    public function __construct()
    {
        $container = new Container();

        Facade::setFacadeApplication($container);

        $container->singleton('http', function () {

            return new Factory();
        });

        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        class_alias(Http::class, 'Http');
    }

    /**
     * load Gateway class
     *
     * @param Gateways $gateway
     */
    public static function gateway(Gateways $gateway): GatewayInterface|Exception
    {
        $class = "Payhub\\Gateways\\{$gateway->value}\\{$gateway->value}Gateway";

        if (! class_exists($class)) {
            return throw new \InvalidArgumentException('Gateway not found');
        }

        $gateway = new $class();

        return $gateway;
    }
}
