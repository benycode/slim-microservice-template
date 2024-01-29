<?php

use Slim\App;
use DI\ContainerBuilder;
use BenyCode\Slim\Abstraction\DI;

require_once __DIR__ . '/../vendor/autoload.php';

$container = (new ContainerBuilder)
    ->addDefinitions(
        \array_merge(
            DI::create(__DIR__ . '/../config'),
            [
             //
            ],
        ),
    )
    ->build()
;

$container
    ->get(App::class)
    ->run()
;
