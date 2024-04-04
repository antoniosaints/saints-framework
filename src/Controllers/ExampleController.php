<?php

namespace App\Controllers;

class ExampleController extends BaseController
{
    public function getJson()
    {
        $data = $this->request::getBody();

        $this->response::json($data);
    }
}