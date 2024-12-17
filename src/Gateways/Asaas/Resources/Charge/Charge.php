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
     * set filters
     *
     * @param array $filters
     * @return ChargeInterface
     */
    public function setFilters(array $filters): ChargeInterface
    {
        $this->filter = $filters;

        return $this;
    }

    /**
     * set customer
     *
     * @param string $customerId
     * @return ChargeInterface
     */
    public function setCustomer(string $customerId): ChargeInterface
    {
        $this->charge['customer'] = $customerId;

        return $this;
    }

    /**
     * find charges by id
     *
     * @return array
     */
    public function find(string $id): array
    {
        return $this->get("payments/{$id}");
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
     * update charge
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function update(string $id, array $data): array
    {
        return $this->put("payments/{$id}", $data);
    }

    /**
     * destroy charge
     *
     * @param string $id
     * @return array
     */
    public function destroy(string $id): bool
    {
        return $this->delete("payments/{$id}");
    }

    /**
     * restore charge
     *
     * @param string $id
     * @return array
     */
    public function restore(string $id): array
    {
        return $this->post("payments/{$id}/restore");
    }

    /**
     * get status charge
     *
     * @param string $id
     * @return array
     */
    public function getStatus(string $id): array
    {
        return $this->get("payments/{$id}/status");
    }

    /**
     * get digitable line
     *
     * @param string $id
     * @return array
     */
    public function getDigitableLine(string $id): string
    {
        return $this->get("payments/{$id}/identificationField")['identificationField'];
    }

    /**
     * get qrcode pix
     *
     * @param string $id
     * @return array
     */
    public function getQrCodePix(string $id): array
    {
        return $this->get("payments/{$id}/pixQrCode");
    }

    /**
     * confirm receipt
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function confirmReceipt(string $id, array $data): array
    {
        return $this->post("payments/{$id}/receiveInCash", $data);
    }

    /**
     * undo confirm receipt
     *
     * @param string $id
     * @return array
     */
    public function undoConfirmReceipt(string $id): array
    {
        return $this->post("payments/{$id}/undoReceivedInCash");
    }
}
