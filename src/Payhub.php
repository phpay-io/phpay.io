<?php

namespace Payhub;

use Dotenv\Dotenv;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use Payhub\Gateways\Asaas\AsaasGateway;
use Payhub\Gateways\Gateway;

class Payhub
{
    /**
     * @var Gateway
     */
    protected Gateway $gateway;

    /**
     * @var array
     */
    protected array $client;

    /**
     * construct
     *
     * @param Gateway $gateway
     */
    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * boot laravel facade
     *
     * @return AsaasGateway
     */
    private static function boot()
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
     * call asaas gateway
     *
     * @return AsaasGateway
     */
    public static function asaas(array $credentials, $sandbox = true): self
    {
        self::boot();

        return new self(new AsaasGateway($credentials, $sandbox));
    }

    /**
     * call gateway
     *
     * @param array $client
     * @return object
     */
    public function client(array $client = []): object
    {
        $this->client = $client;

        return $this->gateway->client($client);
    }
}
