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

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     summary="Authentication",
     *     description="Log in to the system with email and password",
     *     path="/auth/login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *          response="200", description="JWT Token"
     *     )
     * )
     * @param Login $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Login $request): \Illuminate\Http\JsonResponse
    {
        if (! $token = auth()->attempt($request->validated())) {
            return Response::error(401, "Incorrect email/password combination");
        }

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     summary="Logout",
     *     description="Log out of the system",
     *     path="/auth/logout",
     *     @OA\Response(
     *          response="200", description=""
     *     )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();

        return Response::success();
    }

    /**
     * @OA\Post(
     *     tags={"Auth"},
     *     summary="Refresh token",
     *     description="Refresh the jwt token for current logged user",
     *     path="/auth/refresh",
     *     @OA\Response(
     *          response="200", description="JWT Token"
     *     )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
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
