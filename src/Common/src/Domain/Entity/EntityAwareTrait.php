<?php

declare(strict_types=1);

namespace Common\Domain\Entity;

use Cake\Chronos\Chronos;

trait EntityAwareTrait
{
    private ?int $id = null;
    private Chronos $createdAt;
    private ?Chronos $updatedAt = null;
    private ?Chronos $deletedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): Chronos
    {
        return $this->createdAt;
    }

    public function setCreatedAt(Chronos $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?Chronos
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(Chronos $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getDeletedAt(): ?Chronos
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(Chronos $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
