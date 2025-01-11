<?php

namespace PHPay\Asaas\Resources\Pix\Interface;

interface PixInterface
{
    /**
     * set query params
     *
     * @param array<mixed> $queryParams
     * @return PixInterface
     */
    public function setQueryParams(array $queryParams): PixInterface;

    /**
     * create pix key
     *
     * @return array<mixed>
     */
    public function createKey(): array;

    /**
     * find pix key
     *
     * @param string $id
     * @return array<mixed>
     */
    public function find(string $id): array;

    /**
     * get all pix keys
     *
     * @return array<mixed>
     * @see params in https://docs.asaas.com/reference/list-keys
     */
    public function getAll(): array;

    /**
     * destroy pix key
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;

    /**
     * static qr code
     *
     * @param array<mixed> $params
     * @return array<mixed>
     */
    public function staticQrCode(array $params): array;

    /**
     * destroy static qr code
     *
     * @param string $id
     * @return bool
     */
    public function destroyStaticQrCode(string $id): bool;
}
