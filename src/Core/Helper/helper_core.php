<?php
declare(strict_types=1);

defined('APP_PATH') || define('APP_PATH', __DIR__);
defined('BASE_URL') || define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
defined('SAINTSMVC_ENV') || define('SAINTSMVC_ENV', 'dev');

if (!function_exists('baseUrl')) {
    function baseUrl(string $url): string
    {
        return BASE_URL . $url;
    }
}

foreach (glob(APP_PATH . '/src/Helpers/*_helper.php') as $filename) {
    require_once $filename;
}