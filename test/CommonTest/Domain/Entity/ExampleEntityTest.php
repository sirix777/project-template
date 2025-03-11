<?php

declare(strict_types=1);

namespace CommonTest\Domain\Entity;

use ExampleModule\Domain\Entity\ExampleEntity;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(ExampleEntity::class)]
class ExampleEntityTest extends TestCase
{
    #[Test]
    public function emailCanBeSetAndRetrieved(): void
    {
        $entity = new ExampleEntity();
        $name = 'test name';
        $entity->setName($name);

        $this->assertEquals($name, $entity->getName());
    }

    #[Test]
    public function emailCanBeUpdated(): void
    {
        $entity = new ExampleEntity();
        $initialName = 'initial';
        $updatedName = 'updated';
        $entity->setName($initialName);
        $entity->setName($updatedName);

        $this->assertEquals($updatedName, $entity->getName());
    }
}
