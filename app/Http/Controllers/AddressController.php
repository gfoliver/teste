<?php

namespace App\Http\Controllers;

use App\Core\Services\Contracts\IAddressService;

class AddressController extends Controller
{
    /* @var IAddressService */
    protected $addressService;

    public function __construct(IAddressService $addressService)
    {
        $this->addressService = $addressService;
    }


}
