<?php
namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class BaseController {

    protected $request;
    protected $response;
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }
}