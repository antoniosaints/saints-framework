<?php
require_once __DIR__ . '/src/Core/Http/HeaderCheck.php';
require_once __DIR__ . '/src/Core/Helper/helper_core.php';

foreach (glob(__DIR__ . '/src/Routes/*.php') as $filename) {
    require_once $filename;
}