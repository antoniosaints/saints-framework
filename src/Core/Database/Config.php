<?php

namespace App\Core\Database;

class Config
{
    public $connections = [
        'default' => [
            'dbname' => 'saintsmvc',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ]
    ];
}
