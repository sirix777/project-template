<?php

declare(strict_types=1);

namespace Common\Domain\Repository;

use Common\Domain\Entity\EntityInterface;

interface RepositoryInterface
{
    public function findById(int $id): ?EntityInterface;

    public function persist(EntityInterface $entity, bool $cascade): void;
}
