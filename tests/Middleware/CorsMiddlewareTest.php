<?php

use App\Http\Middleware\CorsMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CorsMiddlewareTest extends TestCase
{
    /**
     * Cors middleware `allow origin` header.
     *
     * @return void
     */
    public function testCorsAllowOriginHeaders()
    {
        $request = Request::create('/api/v1/reports', 'OPTIONS');
        $middleware = new CorsMiddleware;
        $response = $middleware->handle($request, function ($req) {});
        $this->assertEquals([
            'method' => 'OPTIONS'
        ], json_decode($response->content(), true));
        
        $headers = $response->headers->all();
        $this->assertEquals(['*'], $headers['access-control-allow-origin']);
        $this->assertEquals(['POST, GET, OPTIONS, PUT, DELETE, PATCH'], $headers['access-control-allow-methods']);
        $this->assertEquals(['true'], $headers['access-control-allow-credentials']);
        $this->assertEquals(['86400'], $headers['access-control-max-age']);
        $this->assertEquals(['Content-Type, Authorization, Accept, X-Requested-With, Application'], $headers['access-control-allow-headers']);
    }
}
