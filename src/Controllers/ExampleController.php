<?php

namespace App\Controllers;

class ExampleController extends BaseController
{
    public function getJson()
    {
        $data = self::request()::getJson();

        self::responseJson($data);
    }
}