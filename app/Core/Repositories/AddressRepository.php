<?php

namespace App\Core\Repositories;

use App\Core\Repositories\Contracts\IAddressRepository;
use App\Models\Address;

class AddressRepository implements IAddressRepository
{
    public function create(array $data): ?Address
    {
        return Address::create($data);
    }

    public function update(int $id, array $data): ?Address
    {
        if (($address = $this->byId($id)) && $address->update($data))
            return $address;

        return null;
    }

    public function delete(int $id): bool
    {
        if (($address = $this->byId($id)) && $address->delete())
            return true;

        return false;
    }

    public function byId(int $id): ?Address
    {
        return Address::find($id);
    }

    public function byIdAndUser(int $id, int $userId): ?Address
    {
        return Address::where('user_id', $userId)->find($id);
    }
}
