<?php

use Slim\App;
use Selective\BasePath\BasePathMiddleware;
use BenyCode\Slim\Middleware\SettingsUpMiddleware;

return function (App $app) {
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->add(BasePathMiddleware::class);
    $app->add(SettingsUpMiddleware::class);
};
