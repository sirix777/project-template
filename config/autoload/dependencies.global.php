<?php

declare(strict_types=1);

use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
    'dependencies' => [
        'aliases' => [],
        'invokables' => [],
        'factories' => [],
        'abstract_factories' => [
            ConfigAbstractFactory::class,
        ],
    ],
];
