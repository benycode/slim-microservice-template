<?php

use Slim\App;
use App\Renderer;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use App\Middleware\ExceptionMiddleware;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use BenyCode\Slim\Middleware\InfoEndpointMiddleware;

return [
    // Application settings
    'settings' => fn () => require __DIR__ . '/settings.php',

    App::class => function (ContainerInterface $container) {

        $app = AppFactory::createFromContainer($container);

        // Register routes
        (require __DIR__ . '/routes.php')($app);

        // Register middleware
        (require __DIR__ . '/middleware.php')($app);

        return $app;
    },

    // HTTP factories
    ResponseFactoryInterface::class => fn (ContainerInterface $container) => $container->get(Psr17Factory::class),

    ServerRequestFactoryInterface::class => fn (ContainerInterface $container) => $container->get(Psr17Factory::class),

    StreamFactoryInterface::class => fn (ContainerInterface $container) => $container->get(Psr17Factory::class),

    UriFactoryInterface::class => fn (ContainerInterface $container) => $container->get(Psr17Factory::class),

    LoggerInterface::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['logger'];
        $logger = new Logger('app');

        $level = $settings['level'];
        $streamHandler  = new StreamHandler('php://stdout', $level);
        $streamHandler ->setFormatter(new LineFormatter(null, null, false, true));
        $logger->pushHandler($streamHandler);

        return $logger;
    },

    ExceptionMiddleware::class => function (ContainerInterface $container) {
        $settings = $container->get('settings')['error'];

        return new ExceptionMiddleware(
            $container->get(ResponseFactoryInterface::class),
            $container->get(Renderer::class),
            $container->get(LoggerInterface::class),
            (bool)$settings['display_error_details'],
        );
    },

    InfoEndpointMiddleware::class => function (ContainerInterface $container) {
        $settings = $container
            ->get('settings')
        ;

        return new InfoEndpointMiddleware(
            $settings['version'],
        );
    },
];
