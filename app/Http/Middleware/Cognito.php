<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use App\Http\Services\CognitoService;


class Cognito
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;
    private $cognitoService;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->cognitoService = new CognitoService();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        $accessToken = $request->header('access_token');
        if($request->header('access_token') == null) {
            return response([
                'message' => 'Unauthorized: Token not provided',
                'success' => false,
            ], 401);
        }
        // check token from aws-cognito
        if (!$this->cognitoService->verifyAccessToken($accessToken)) {
            return response([
                'message' => 'Unauthorized: Token invalid',
                'success' => false,
            ], 401);
        }
        // TODO:andy-shi88=check permission json
        return $next($request);
    }
}
