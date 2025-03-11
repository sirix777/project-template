<?php

declare(strict_types=1);

use ApiGateway\Infra\Handler\PingHandler;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
    'dependencies' => [
        'invokables' => [
            PingHandler::class => PingHandler::class,
        ],
        'factories' => [
        ],
    ],
    ConfigAbstractFactory::class => [
    ],
];
