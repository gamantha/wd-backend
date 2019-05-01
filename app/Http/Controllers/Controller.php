<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {
    protected $service = null;

    /**
     * construct with service
     */
    function __construct($service) {
        $this->service = $service;
    }

}
