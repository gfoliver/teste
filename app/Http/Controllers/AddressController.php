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

    /**
     * @OA\Post(
     *     tags={"Address"},
     *     summary="Create address",
     *     description="Create a new address linked to the logged user",
     *     path="/address",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="street", type="string"),
     *             @OA\Property(property="number", type="integer"),
     *             @OA\Property(property="neighborhood", type="string"),
     *             @OA\Property(property="complement", type="string"),
     *             @OA\Property(property="zip_code", type="string"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Address data")
     * )
     * @param Create $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Create $request)
    {
        if ($address = $this->addressService->create($request->validated()))
            return Response::success($address->toArray());

        return Response::error();
    }

    /**
     * @OA\Get(
     *     tags={"Address"},
     *     summary="Address info",
     *     description="Get address data, restricted by logged user",
     *     path="/address/{id}",
     *     @OA\Response(response="200", description="Address data")
     * )
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function info(int $id)
    {
        if ($address = $this->addressService->byIdAndUser($id, auth()->id()))
            return Response::success($address->toArray());

        return Response::error(404, 'Address not found or user doesn\'t have permission');
    }

    /**
     * @OA\Delete(
     *     tags={"Address"},
     *     summary="Delete address",
     *     description="Delete an address, restricted by logged user",
     *     path="/address/{id}",
     *     @OA\Response(response="200", description="")
     * )
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @OA\Put(
     *     tags={"Address"},
     *     summary="Update address",
     *     description="Update address data, restricted by logged user",
     *     path="/address/{id}",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="street", type="string"),
     *             @OA\Property(property="number", type="integer"),
     *             @OA\Property(property="neighborhood", type="string"),
     *             @OA\Property(property="complement", type="string"),
     *             @OA\Property(property="zip_code", type="string"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Address data")
     * )
     * @param Update $request
     * @return \Illuminate\Http\JsonResponse
     */
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
