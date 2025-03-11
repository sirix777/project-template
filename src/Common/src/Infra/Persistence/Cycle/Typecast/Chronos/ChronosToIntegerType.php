<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Chronos;

use Cake\Chronos\Chronos;
use InvalidArgumentException;
use Override;

use function is_int;
use function is_string;

class ChronosToIntegerType extends AbstractChronosType
{
    #[Override]
    protected function toDatabaseValue(Chronos $value): string
    {
        return (string) $value->getTimestamp();
    }

    #[Override]
    protected function toPhpValue(mixed $value): Chronos
    {
        if (! is_string($value) && ! is_int($value)) {
            throw new InvalidArgumentException('Incorrect value.');
        }

        return Chronos::createFromTimestamp((int) $value, 'UTC');
    }
}
