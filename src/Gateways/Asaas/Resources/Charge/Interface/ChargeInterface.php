<?php

namespace Asaas\Resources\Charge\Interface;

interface ChargeInterface
{
    public function getAll(): array;
    public function find(string $id): array;
    public function create(): array;
    public function update(string $id, array $data): array;
    public function destroy(string $id): bool;
    public function restore(string $id): array;
    public function setCustomer(string $customer): ChargeInterface;
    public function setFilters(array $filters): ChargeInterface;
    public function getStatus(string $id): array;
    public function getDigitableLine(string $id): string;
    public function getQrCodePix(string $id): array;
    public function confirmReceipt(string $id, array $data): array;
    public function undoConfirmReceipt(string $id): array;
}
