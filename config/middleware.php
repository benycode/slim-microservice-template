<?php

use Slim\App;
use BenyCode\Slim\Middleware\SettingsUpMiddleware;
use BenyCode\Slim\Middleware\ExceptionMiddleware;

return function (App $app) {
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->add(SettingsUpMiddleware::class);
    $app->add(ExceptionMiddleware::class);
};
