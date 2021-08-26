<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Services\Contracts\IAddressService;
use App\Http\Requests\Address\Create;
use App\Http\Requests\Address\Update;

class AddressController extends Controller
{
    /* @var IAddressService */
    protected $addressService;

    public function __construct(IAddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function create(Create $request)
    {
        if ($address = $this->addressService->create($request->validated()))
            return Response::success($address->toArray());

        return Response::error();
    }

    public function info(int $id)
    {
        if ($address = $this->addressService->byIdAndUser($id, auth()->id()))
            return Response::success($address->toArray());

        return Response::error(404, 'Address not found or user doesn\'t have permission');
    }

    public function delete(int $id)
    {
        if (
            ($address = $this->addressService->byIdAndUser($id, auth()->id()))
            && $this->addressService->delete($address->getKey())
        )
        {
            return Response::success();
        }

        return Response::error(404, 'Address not found or user doesn\'t have permission');
    }

    public function update(int $id, Update $request)
    {
        if (
            ($address = $this->addressService->byIdAndUser($id, auth()->id()))
            && $updated = $this->addressService->update($address->getKey(), $request->validated())
        )
        {
            return Response::success($updated->toArray());
        }

        return Response::error(404, 'Address not found or user doesn\'t have permission');
    }
}
