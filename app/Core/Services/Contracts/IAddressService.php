<?php

namespace App\Core\Services\Contracts;

use App\Models\Address;

interface IAddressService
{
    public function create(array $data): ?Address;

    public function update(int $id, array $data): ?Address;

    public function delete(int $id): bool;

    public function byId(int $id): ?Address;
}
