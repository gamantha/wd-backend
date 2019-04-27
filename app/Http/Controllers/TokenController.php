<?php

namespace App\Http\Controllers;

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
      return response([
        "message" => "token valid",
        "success" => true,
      ]);
    }

    //
}
