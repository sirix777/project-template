<?php

declare(strict_types=1);

use Common\Infra\Persistence\Cycle\Listener\ChronosCreatedAtListener;
use Common\Infra\Persistence\Cycle\Listener\ChronosSoftDeleteListener;
use Common\Infra\Persistence\Cycle\Listener\ChronosUpdatedAtListener;
use Cycle\ORM\Entity\Behavior\Listener\OptimisticLock;
use Cycle\ORM\SchemaInterface;
use ExampleModule\Domain\Entity\ExampleEntity;
use ExampleModule\Infra\Persistence\Cycle\ExampleListener;
use ExampleModule\Infra\Persistence\Cycle\ExampleTypecast;

return [
    'cycle' => [
        'schema' => [
            'manual_mapping_schema_definitions' => [
                'example' => [
                    SchemaInterface::ENTITY => ExampleEntity::class,
                    SchemaInterface::DATABASE => 'main-db',
                    SchemaInterface::TABLE => 'example',
                    SchemaInterface::PRIMARY_KEY => 'id',
                    SchemaInterface::COLUMNS => [
                        'id' => 'id',
                        'name' => 'name',
                        'createdAt' => 'created_at',
                        'updatedAt' => 'updated_at',
                        'deletedAt' => 'deleted_at',
                        'version' => 'version',
                    ],
                    SchemaInterface::TYPECAST => [
                        'id' => 'int',
                        'name' => 'string',
                        'createdAt' => 'datetime',
                        'updatedAt' => 'datetime',
                        'deletedAt' => 'datetime',
                        'version' => 'int',
                    ],
                    SchemaInterface::TYPECAST_HANDLER => [
                        ExampleTypecast::class,
                    ],
                    SchemaInterface::LISTENERS => [
                        ExampleListener::class,
                        ChronosCreatedAtListener::class,
                        ChronosUpdatedAtListener::class,
                        ChronosSoftDeleteListener::class,
                        OptimisticLock::class,
                    ],
                    SchemaInterface::RELATIONS => [],
                ],
            ],
        ],
    ],
];
