<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Response;
use App\Core\Services\Contracts\IUserService;
use App\Http\Requests\Auth\Login;


class AuthController extends Controller
{
    /* @var IUserService */
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Login $request): \Illuminate\Http\JsonResponse
    {
        if (! $token = auth()->attempt($request->validated())) {
            return Response::error(401, "Incorrect email/password combination");
        }

        return $this->respondWithToken($token);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return Response::success();
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return Response::success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
