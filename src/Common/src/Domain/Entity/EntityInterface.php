<?php

declare(strict_types=1);

namespace Common\Domain\Entity;

use Cake\Chronos\Chronos;

interface EntityInterface
{
    public function getId(): ?int;

    public function setId(int $id): void;

    public function getCreatedAt(): ?Chronos;

    public function setCreatedAt(Chronos $updatedAt): void;

    public function getUpdatedAt(): ?Chronos;

    public function setUpdatedAt(Chronos $updatedAt): void;
}
