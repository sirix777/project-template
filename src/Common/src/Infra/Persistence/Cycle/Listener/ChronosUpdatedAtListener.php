<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Listener;

use Cake\Chronos\Chronos;
use Cycle\ORM\Command\StoreCommandInterface;
use Cycle\ORM\Entity\Behavior\Attribute\Listen;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command\OnCreate;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command\OnUpdate;

final readonly class ChronosUpdatedAtListener
{
    public function __construct(private string $field = 'updatedAt', private bool $nullable = false) {}

    #[Listen(OnUpdate::class)]
    public function __invoke(OnUpdate $event): void
    {
        if ($event->command instanceof StoreCommandInterface) {
            $event->command->registerAppendix($this->field, Chronos::instance($event->timestamp));
        }
    }

    #[Listen(OnCreate::class)]
    public function onCreate(OnCreate $event): void
    {
        if (! $this->nullable) {
            $event->state->register($this->field, Chronos::instance($event->timestamp));
        }
    }
}
