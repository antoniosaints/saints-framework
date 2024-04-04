<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Routes/Api.php';

use App\Core\Core;
use App\Http\Route;

Core::dispatch(Route::routes());