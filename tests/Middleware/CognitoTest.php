<?php

use App\Http\Middleware\Cognito;
use App\Http\Errors\CognitoErrors;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CognitoTest extends TestCase
{
    /**
     * Cors middleware `allow origin` header.
     *
     * @return void
     */
    public function testCognitoNoAuthorizationHeader()
    {
        $request = Request::create('/api/v1/reports', 'GET');
        $middleware = new Cognito;
        $response = $middleware->handle($request, function ($req) {});
        $this->assertEquals([
          'meta' => [
            'message' => 'Unauthorized: Token not provided',
            'success' => false,
            'errors' =>  [
              CognitoErrors::$TokenInvalid,
            ]
          ],
          'data' => [],
          'links' => null
        ], json_decode($response->content(), true));
    }

    public function testCognitoNoBearerAuthorizationHeader()
    {
        $server = $this->transformHeadersToServerVars(['Authorization' => 'random token']);
        $request = Request::create('/api/v1/reports', 'GET',$parameters = [], $cookies = [], $files = [], $server = $server);
        $middleware = new Cognito;
        $response = $middleware->handle($request, function ($req) {});
        $this->assertEquals([
          'meta' => [
            'message' => 'Unauthorized: Token invalid',
            'success' => false,
            'errors' =>  [
              CognitoErrors::$TokenInvalid,
            ]
          ],
          'data' => [],
          'links' => null
        ], json_decode($response->content(), true));
    }

    public function testCognitoTokenInvalid()
    {
        $server = $this->transformHeadersToServerVars(['Authorization' => 'bearer token']);
        $request = Request::create('/api/v1/reports', 'GET',$parameters = [], $cookies = [], $files = [], $server = $server);
        $middleware = new Cognito;
        $response = $middleware->handle($request, function ($req) {});
        $this->assertEquals([
          'meta' => [
            'message' => 'Unauthorized: Token invalid',
            'success' => false,
            'errors' =>  [
              CognitoErrors::$TokenInvalid,
            ]
          ],
          'data' => [],
          'links' => null
        ], json_decode($response->content(), true));
    }

}
