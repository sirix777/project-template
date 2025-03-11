<?php

declare(strict_types=1);

use Common\Infra\Persistence\Cycle\Select\SelectFactory;
use Cycle\ORM\ORMInterface;
use ExampleModule\Infra\Persistence\Cycle\ExampleRepository;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
    'dependencies' => [
        'invokables' => [
        ],
        'factories' => [
            ExampleRepository::class => ConfigAbstractFactory::class,
        ],
    ],
    ConfigAbstractFactory::class => [
        ExampleRepository::class => [
            ORMInterface::class,
            SelectFactory::class,
        ],
    ],
];
