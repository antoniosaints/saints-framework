<?php

namespace App\Controllers;

class ExampleController extends BaseController
{
    public function getJson()
    {
        $data = $this->request::getJson();

        $this->response::json($data);
    }
}