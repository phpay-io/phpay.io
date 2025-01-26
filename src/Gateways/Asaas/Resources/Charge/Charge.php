<?php

namespace PHPay\Asaas\Resources\Charge;

use GuzzleHttp\Client;
use PHPay\Asaas\Requests\AsaasChargeRequest;
use PHPay\Asaas\Resources\Charge\Interface\ChargeInterface;
use PHPay\Asaas\Resources\Customer\Customer;
use PHPay\Asaas\Traits\HasAsaasClient;

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
     * @var array<mixed>
     */
    private array $queryParams = [];

    /**
     * @var array<mixed>
     */
    private array $charge = [];

    /**
     * construct
     */
    public function __construct(
        private string $token,
        private bool $sandbox = true,
    ) {
        $this->client = $this->clientAsaasBoot();
    }

    /**
     * set charge
     *
     * @param array<mixed> $charge
     * @return ChargeInterface
     */
    public function setCharge(array $charge): ChargeInterface
    {
        $this->charge = $charge;

        return $this;
    }

    /**
     * set query params
     *
     * @param array<mixed> $queryParams
     * @return ChargeInterface
     */
    public function setQueryParams(array $queryParams): ChargeInterface
    {
        $this->queryParams = $queryParams;

        return $this;
    }

    /**
     * set customer
     *
     * @param array<mixed> $customer
     * @return ChargeInterface
     */
    public function setCustomer(array $customer): ChargeInterface
    {
        $customer = (new Customer(
            $this->token,
            $customer,
            $this->sandbox
        ))->create();

        $this->charge['customer'] = $customer['id'];

        return $this;
    }

    /**
     * find charges by id
     *
     * @return array<array|mixed>
     */
    public function find(string $id): array
    {
        return $this->get("payments/{$id}");
    }

    /**
     * get all charges
     *
     * @return array<array|mixed>
     */
    public function getAll(): array
    {
        return $this->get('payments', $this->queryParams);
    }

    /**
     * create charge
     *
     * @return string
     * @return array<mixed>
     * @see fields available in https://docs.asaas.com/reference/criar-nova-cobranca
     */
    public function create(): array
    {
        AsaasChargeRequest::validate($this->charge);

        return $this->post('payments', $this->charge);
    }

    /**
     * update charge
     *
     * @param string $id
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function update(string $id, array $data): array
    {
        return $this->put("payments/{$id}", $data);
    }

    /**
     * destroy charge
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool
    {
        return $this->delete("payments/{$id}");
    }

    /**
     * restore charge
     *
     * @param string $id
     * @return array<mixed>
     */
    public function restore(string $id): array
    {
        return $this->post("payments/{$id}/restore");
    }

    /**
     * get status charge
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function getStatus(string $id): array
    {
        return $this->get("payments/{$id}/status");
    }

    /**
     * get digitable line
     *
     * @param string $id
     * @return mixed
     */
    public function getDigitableLine(string $id): mixed
    {
        $charge = $this->get("payments/{$id}/identificationField");

        if (isset($charge['identificationField'])) {
            return $charge['identificationField'];
        }

        return null;
    }

    /**
     * get qrcode pix
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function getQrCodePix(string $id): array
    {
        return $this->get("payments/{$id}/pixQrCode");
    }

    /**
     * confirm receipt
     *
     * @param string $id
     * @param array<mixed> $data
     * @return array<mixed>
     */
    public function confirmReceipt(string $id, array $data): array
    {
        return $this->post("payments/{$id}/receiveInCash", $data);
    }

    /**
     * undo confirm receipt
     *
     * @param string $id
     * @return array<mixed>
     */
    public function undoConfirmReceipt(string $id): array
    {
        return $this->post("payments/{$id}/undoReceivedInCash");
    }
}
