<?php

namespace Asaas\Resources\Charge;

use Asaas\Requests\AsaasChargeRequest;
use Asaas\Resources\Charge\Interface\ChargeInterface;
use Asaas\Traits\HasAsaasClient;
use GuzzleHttp\Client;

class Charge implements ChargeInterface
{
    /**
     * trait asaas client
     */
    use HasAsaasClient;

    /**
     * client guzzle
     */
    private Client $client;

    /**
     * @var array
     */
    private array $filter = [];

    /**
     * construct
     *
     * @param array $charge
     */
    public function __construct(
        private array $charge = [],
        private string $token,
        private bool $sandbox = true
    ) {
        $this->client = $this->clientAsaasBoot();

        if (!empty($charge)) {
            $this->charge = $charge;
        }

        return $this;
    }

    /**
     * set customer
     *
     * @param string $customer
     * @return ChargeInterface
     */
    public function setCustomer(string $customer): ChargeInterface
    {
        $this->charge['customer'] = $customer;

        return $this;
    }

    /**
     * get all charges
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->get('payments', [
            'query' => $this->filter,
        ]);
    }

    /**
     * create charge
     *
     * @return string
     * @see fields available in https://docs.asaas.com/reference/criar-nova-cobranca
     */
    public function create(): array
    {
        AsaasChargeRequest::validate($this->charge);

        return $this->post('payments', $this->charge);
    }

    /**
     * create charge lean
     *
     * @return string
     * @see fields available in https://docs.asaas.com/reference/criar-nova-cobranca-com-dados-resumidos-na-resposta
     */
    public function createLean(): array
    {
        AsaasChargeRequest::validate($this->charge);

        return $this->post('lean/payments', $this->charge);
    }
}
