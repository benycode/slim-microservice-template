<?php

error_reporting(0);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

if (isset($_ENV['api_error']) && is_string($_ENV['api_error']) && null !== json_decode($_ENV['api_error'])) {
    $api_error = json_decode($_ENV['api_error'], true);

    if(true === $api_error['display_error_details']) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
    }
}

use BenyCode\Slim\Abstraction\App;

require_once __DIR__ . '/../vendor/autoload.php';

date_default_timezone_set('Europe/Vilnius');

App::run(
    [__DIR__ . '/../app/Action/'],
    [],
);
