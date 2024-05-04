<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Core/Bootstrap.php';

use App\Core\Core;
use App\Core\Http\Route;

Core::dispatch(Route::routes());