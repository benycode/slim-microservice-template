<?php

use Slim\App;
use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

// Build DI container instance
$container = (new ContainerBuilder)
    ->addDefinitions(__DIR__ . '/container.php')
    ->build();

// Create App instance
return $container
    ->get(App::class)
;
