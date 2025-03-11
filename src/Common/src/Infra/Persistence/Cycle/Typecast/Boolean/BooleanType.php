<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Boolean;

use Override;
use Vjik\CycleTypecast\TypeInterface;

class BooleanType implements TypeInterface
{
    #[Override]
    public function convertToDatabaseValue(mixed $value): int
    {
        return (int) $value;
    }

    #[Override]
    public function convertToPhpValue(mixed $value): bool
    {
        return (bool) $value;
    }
}
