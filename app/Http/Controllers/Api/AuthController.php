<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $jsonResponseService;

    public function __construct(JsonResponseService $jsonResponseService)
    {
        $this->middleware('jwt', ['except' => ['login', 'register']]);
        $this->jsonResponseService = $jsonResponseService;
    }

    protected function respondWithToken($token)
    {
        return $this->jsonResponseService->success('Successfully logged in', [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return $this->jsonResponseService->error('Unauthorized', null, 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return $this->jsonResponseService->success('User retrieved successfully', auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return  $this->jsonResponseService->success('Successfully logged out');
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
}
