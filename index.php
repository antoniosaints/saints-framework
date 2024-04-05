<?php

use App\Core\Core;
use App\Http\Route;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Routes/Api.php';

Core::dispatch(Route::routes());