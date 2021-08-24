<?php

namespace App\Core\Repositories\Contracts;

use App\Models\Address;

interface IAddressRepository
{
    public function create(array $data): ?Address;

    public function update(int $id, array $data): ?Address;

    public function delete(int $id): bool;

    public function byId(int $id): ?Address;
}
