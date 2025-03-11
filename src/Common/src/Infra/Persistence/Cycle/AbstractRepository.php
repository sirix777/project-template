<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle;

use Common\Domain\Entity\EntityInterface;
use Common\Infra\Persistence\Cycle\Exception\RepositoryPersistException;
use Common\Infra\Persistence\Cycle\Select\SelectFactory;
use Cycle\ORM\EntityManager;
use Cycle\ORM\EntityManagerInterface;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select\Repository;
use Throwable;

/**
 * @template TEntity of EntityInterface
 *
 * @extends Repository<TEntity>
 */
abstract class AbstractRepository extends Repository
{
    private readonly EntityManagerInterface $entityManager;

    /**
     * @param SelectFactory<TEntity> $selectFactory
     */
    public function __construct(protected readonly ORMInterface $orm, SelectFactory $selectFactory)
    {
        parent::__construct($selectFactory($this->getEntityClass()));
        $this->entityManager = new EntityManager($this->orm);
    }

    public function findById(int $id): ?EntityInterface
    {
        return $this->findByPK($id);
    }

    /**
     * @throws RepositoryPersistException
     */
    public function persist(EntityInterface $entity, bool $flush = false, bool $cascade = true): void
    {
        $this->entityManager->persist(
            $entity,
            $cascade
        );

        if ($flush) {
            try {
                $this->entityManager->run();
            } catch (Throwable $e) {
                throw new RepositoryPersistException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    /**
     * @throws RepositoryPersistException
     */
    public function delete(EntityInterface $entity, bool $flush = false, bool $cascade = true): void
    {
        $this->entityManager->delete(
            $entity,
            $cascade
        );

        if ($flush) {
            try {
                $this->entityManager->run();
            } catch (Throwable $e) {
                throw new RepositoryPersistException($e->getMessage(), $e->getCode(), $e);
            }
        }
    }

    /**
     * @return class-string<TEntity>
     */
    abstract protected function getEntityClass(): string;
}
