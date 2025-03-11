<?php

declare(strict_types=1);

namespace ExampleModule\Domain\Entity;

use Common\Domain\Entity\EntityAwareTrait;
use Common\Domain\Entity\EntityInterface;

class ExampleEntity implements EntityInterface
{
    use EntityAwareTrait;

    private string $name;
    private int $version;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): void
    {
        $this->version = $version;
    }
}
