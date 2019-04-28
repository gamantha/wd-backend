<?php

namespace App\Http\Controllers;

use App\Http\Builders\ResponseBuilder;

class TokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function checkToken() {
      // middleware check passed return true
      $responseBuilder = new ResponseBuilder();
      $response = $responseBuilder->setMessage('token valid')->setSuccess(true)->build();
      return $response;
    }

    //
}
