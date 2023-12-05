<?php

namespace App\Store\Auth\Presentation\HTTP\Controllers;

use App\Store\Auth\Domain\AuthInterface;
use App\Store\Auth\Presentation\HTTP\Requests\LoginRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private AuthInterface $auth;

    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
        $token = $this->auth->login($request->all());
        return $this->respondWithToken($token);
        } catch (AuthenticationException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function me(): JsonResponse
    {
        return response()->json($this->auth->me()->toArray());
    }

    public function refresh(): JsonResponse
    {
        try {
            $token = $this->auth->refresh();
        } catch (AuthenticationException $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $this->respondWithToken($token);
    }

    public function logout(): JsonResponse
    {
        $this->auth->logout();
        return response()->json();
    }


    /**
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => config('jwt.ttl') * 1
        ]);
    }
}
