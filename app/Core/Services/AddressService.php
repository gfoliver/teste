<?php

namespace App\Core\Services;

use App\Core\Repositories\Contracts\IAddressRepository;
use App\Core\Services\Contracts\IAddressService;
use App\Models\Address;

class AddressService implements IAddressService
{
    /* @var IAddressRepository */
    protected $addressRepository;

    public function __construct(IAddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function create(array $data): ?Address
    {
        return $this->addressRepository->create($data);
    }

    public function update(int $id, array $data): ?Address
    {
        return $this->addressRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->addressRepository->delete($id);
    }

    public function byId(int $id): ?Address
    {
        return $this->addressRepository->byId($id);
    }
}
