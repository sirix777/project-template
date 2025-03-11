<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Chronos;

use Cake\Chronos\Chronos;
use InvalidArgumentException;
use Override;
use Vjik\CycleTypecast\TypeInterface;

abstract class AbstractChronosType implements TypeInterface
{
    #[Override]
    public function convertToDatabaseValue(mixed $value): mixed
    {
        if (null === $value) {
            return null;
        }

        if (! $value instanceof Chronos) {
            throw new InvalidArgumentException('Incorrect value.');
        }

        return $this->toDatabaseValue($value);
    }

    #[Override]
    public function convertToPhpValue(mixed $value): ?Chronos
    {
        if (null === $value) {
            return null;
        }

        return $this->toPhpValue($value);
    }

    abstract protected function toDatabaseValue(Chronos $value): mixed;

    abstract protected function toPhpValue(mixed $value): Chronos;
}
