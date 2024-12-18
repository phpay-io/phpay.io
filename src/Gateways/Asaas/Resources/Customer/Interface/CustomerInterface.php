<?php

namespace Asaas\Resources\Customer\Interface;

interface CustomerInterface
{
    /**
     * find customer by id
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function find(string $id): array;

    /**
     * get all customers
     *
     * @return array<array|mixed>
     */
    public function getAll(): array;

    /**
     * create customer
     *
     * @return array<array|mixed>
     */
    public function create(): array;

    /**
     * update customer by id
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function update(string $id): array;

    /**
     * delete customer by id
     *
     * @param string $id
     * @return bool
     */
    public function destroy(string $id): bool;

    /**
     * restore customer by id
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function restore(string $id): array;

    /**
     * get customer notifications by id
     *
     * @param string $id
     * @return array<array|mixed>
     */
    public function getNotifications(string $id): array;

    /**
     * set filter
     *
     * @param array<mixed> $filter
     * @return self
     */
    public function setFilter(array $filter = []): self;
}
