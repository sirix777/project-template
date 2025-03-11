<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Chronos;

use Cake\Chronos\Chronos;
use InvalidArgumentException;
use Override;

use function is_string;

class ChronosToDateTimeType extends AbstractChronosType
{
    #[Override]
    protected function toDatabaseValue(Chronos $value): string
    {
        return $value->toDateTimeString();
    }

    #[Override]
    protected function toPhpValue(mixed $value): Chronos
    {
        if (! is_string($value)) {
            throw new InvalidArgumentException('Incorrect value.');
        }

        return Chronos::createFromFormat(Chronos::DEFAULT_TO_STRING_FORMAT, $value, 'UTC');
    }
}
