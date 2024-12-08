<?php

namespace PHPay;

use Dotenv\Dotenv;
use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\{Facade, Http};
use PHPay\Gateways\Asaas\AsaasGateway;
use PHPay\Gateways\Gateway;

class PHPay
{
    /**
     * construct
     *
     * @param Gateway $gateway
     */
    public function __construct(
        protected Gateway $gateway,
        protected array $client = [],
        protected array $invoice = []
    ) {
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
    public static function asaas(string $token, $sandbox = true): self
    {
        self::boot();

        return new self(new AsaasGateway($token, $sandbox));
    }

    /**
     * call gateway
     *
     * @param array $client
     * @return object
     */
    public function client(array $client = [], $createOnly = true): object
    {
        return $this->gateway->client($client, $createOnly);
    }

    /**
     * call invoice
     *
     * @param array $invoice
     * @return object
     */
    public function invoice(array $invoice = [], $createOnly = true): object
    {
        return $this->gateway->invoice($invoice, $createOnly);
    }
}
