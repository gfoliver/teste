<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Services\Contracts\IUserService;
use App\Http\Requests\User\Create;
use App\Http\Requests\User\Update;

class UserController extends Controller
{
    /* @var IUserService */
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Create $request)
    {
        if ($user = $this->userService->create($request->validated()))
            return Response::success($user->toArray());

        return Response::error();
    }

    public function update(Update $request)
    {
        if ($user = $this->userService->update(auth()->id(), $request->validated()))
            return Response::success($user->toArray());

        return Response::error();
    }

    public function info()
    {
        if ($user = $this->userService->byId(auth()->id(), ['addresses']))
            return Response::success($user->toArray());

        return Response::error();
    }

    public function delete()
    {
        if ($this->userService->delete(auth()->id())) {
            auth()->logout();
            return Response::success();
        }

        return Response::error();
    }
}
