<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Select;

use Common\Domain\Entity\EntityInterface;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select;
use InvalidArgumentException;

use function is_a;

/**
 * @template TEntity of EntityInterface
 */
readonly class SelectFactory
{
    public function __construct(private ORMInterface $orm) {}

    /**
     * @param class-string<TEntity> $role
     *
     * @return Select<TEntity>
     */
    public function __invoke(string $role): Select
    {
        return $this->assertRoleAndCreateSelect($role);
    }

    /**
     * @template T of EntityInterface
     *
     * @param class-string<T> $role
     *
     * @return Select<T> $select
     */
    private function assertRoleAndCreateSelect(string $role): Select
    {
        /** @var Select<T> $select */
        $select = new Select($this->orm, $role);

        if (! is_a($role, EntityInterface::class, true)) {
            throw new InvalidArgumentException('Invalid entity class');
        }

        return $select;
    }
}
