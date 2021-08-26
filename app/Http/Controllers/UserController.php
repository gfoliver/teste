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

    /**
     * @OA\Post(
     *     tags={"User"},
     *     summary="Register user",
     *     description="Register a new user with name, email, password, cpf and phone",
     *     path="/user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="cpf", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="password", type="string"),
     *             @OA\Property(property="password_confirmation", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", description="User data"
     *     )
     * )
     * @param Create $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Create $request)
    {
        if ($user = $this->userService->create($request->validated()))
            return Response::success($user->toArray());

        return Response::error();
    }

    /**
     * @OA\Put(
     *     tags={"User"},
     *     summary="Update user data",
     *     description="Update logged user data",
     *     path="/user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="cpf", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", description="User data"
     *     )
     * )
     * @param Create $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Update $request)
    {
        if ($user = $this->userService->update(auth()->id(), $request->validated()))
            return Response::success($user->toArray());

        return Response::error();
    }

    /**
     * @OA\Get(
     *     tags={"User"},
     *     summary="Get logged user data",
     *     description="Get logged user data",
     *     path="/user/info",
     *     @OA\Response(response="200", description="User data")
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        if ($user = $this->userService->byId(auth()->id(), ['addresses']))
            return Response::success($user->toArray());

        return Response::error();
    }

    /**
     * @OA\Delete(
     *     tags={"User"},
     *     summary="Delete logged user",
     *     description="Delete logged user",
     *     path="/user",
     *     @OA\Response(response="200", description="")
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete()
    {
        if ($this->userService->delete(auth()->id())) {
            auth()->logout();
            return Response::success();
        }

        return Response::error();
    }
}
