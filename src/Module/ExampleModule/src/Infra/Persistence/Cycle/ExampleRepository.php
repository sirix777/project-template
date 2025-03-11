<?php

declare(strict_types=1);

namespace ExampleModule\Infra\Persistence\Cycle;

use Common\Infra\Persistence\Cycle\AbstractRepository;
use ExampleModule\Domain\Entity\ExampleEntity;

/**
 * @template TEntity of ExampleEntity
 *
 * @extends AbstractRepository<TEntity>
 */
class ExampleRepository extends AbstractRepository
{
    /**
     * @return class-string
     */
    protected function getEntityClass(): string
    {
        return ExampleEntity::class;
    }
}
