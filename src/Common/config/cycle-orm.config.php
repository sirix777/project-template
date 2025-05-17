<?php

declare(strict_types=1);

use Cycle\Database\Config;

use function Sirix\Config\env;

return [
    'cycle' => [
        'db-config' => [
            'databases' => [
                'main-db' => [
                    'connection' => 'postgres',
                ],
            ],
            'connections' => [
                'postgres' => new Config\PostgresDriverConfig(
                    connection: new Config\Postgres\TcpConnectionConfig(
                        database: env('DATABASE_NAME', 'postgresql'),
                        host: env('DATABASE_HOST', 'localhost'),
                        port: env('DATABASE_PORT', '15432'),
                        user: env('DATABASE_USER', 'postgresql'),
                        password: env('DATABASE_PASS', 'password'),
                    ),
                    reconnect: true,
                    timezone: 'UTC',
                    queryCache: true,
                ),
            ],
        ],
        'migrator' => [
            'directory' => 'data/db/cycle/migrations',
            'table' => 'migrations',
            'seed-directory' => 'data/db/cycle/seeds',
        ],
        'entities' => [
            'src/Module/ExampleModule/src/Infra',
        ],
        'schema' => [
            'property' => null,
            'cache' => [
                'enabled' => true,
                'service' => 'Cache\Symfony\Filesystem',
            ],
        ],
    ],
];
