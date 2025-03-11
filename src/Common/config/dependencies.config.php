<?php

declare(strict_types=1);

use Common\Infra\Persistence\Cycle\Select\SelectFactory;
use Cycle\ORM\ORMInterface;
use Laminas\ServiceManager\AbstractFactory\ConfigAbstractFactory;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

return [
    'dependencies' => [
        'factories' => [
            SelectFactory::class => ConfigAbstractFactory::class,
            FilesystemAdapter::class => ConfigAbstractFactory::class,
        ],
        'aliases' => [
            ORMInterface::class => 'orm',
            'Cache\Symfony\Filesystem' => FilesystemAdapter::class,
        ],
    ],
    ConfigAbstractFactory::class => [
        SelectFactory::class => [
            ORMInterface::class,
        ],
        FilesystemAdapter::class => [
            'config.cache.symfony.filesystem.namespace_prefix',
            'config.cache.symfony.filesystem.default_ttl',
            'config.cache.symfony.filesystem.directory',
        ],
    ],
];
