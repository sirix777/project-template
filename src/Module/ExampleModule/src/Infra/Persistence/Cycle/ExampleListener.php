<?php

declare(strict_types=1);

namespace ExampleModule\Infra\Persistence\Cycle;

use Cycle\ORM\Entity\Behavior\Attribute\Listen;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command;
use ExampleModule\Domain\Entity\ExampleEntity;
use Psr\Log\LoggerInterface;

final readonly class ExampleListener
{
    public function __construct(private LoggerInterface $logger) {}

    #[Listen(Command\OnCreate::class)]
    #[Listen(Command\OnUpdate::class)]
    public function doSomething(Command\OnCreate|Command\OnUpdate $event): void
    {
        /** @var ExampleEntity $entity */
        $entity = $event->entity;

        $this->logger->info('Example listener for entity ' . $event->role, ['name' => $entity->getName()]);
    }
}
