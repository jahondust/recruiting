<?php

namespace App\Services;

use App\Http\Resources\Api\Auth\UserResource;
use App\Models\User;

class AuthService
{
    /**
     * Get a JWT via given credentials.
     *
     * @param array $credentials
     * @return array
     */
    public function login(array $credentials): array
    {
        if (! $token = auth()->attempt($credentials)) {
            return abort(400, 'Unauthorized');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Register new user.
     *
     * @param array $data
     * @return UserResource
     */
    public function register(array $data): UserResource
    {
        $data['password'] = bcrypt($data['password']);
        return UserResource::make(User::create($data));
    }

    /**
     * Get the authenticated User.
     *
     * @return UserResource
     */
    public function me(): UserResource
    {
        return UserResource::make(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return array
     */
    public function logout(): array
    {
        auth()->logout();

        return [];
    }

    /**
     * Refresh a token.
     *
     * @return array
     */
    public function refresh(): array
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
     */
    function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
