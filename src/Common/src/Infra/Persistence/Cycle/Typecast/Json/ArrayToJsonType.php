<?php

declare(strict_types=1);

namespace Common\Infra\Persistence\Cycle\Typecast\Json;

use InvalidArgumentException;
use JsonException;
use Override;
use Vjik\CycleTypecast\TypeInterface;

use function is_array;
use function json_decode;
use function json_encode;
use function json_validate;

class ArrayToJsonType implements TypeInterface
{
    /**
     * @throws JsonException
     */
    #[Override]
    public function convertToDatabaseValue(mixed $value): string
    {
        if (false === is_array($value)) {
            throw new InvalidArgumentException('Value must be an array.');
        }

        return json_encode($value, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array<string, mixed>
     *
     * @throws JsonException
     */
    #[Override]
    public function convertToPhpValue(mixed $value): array
    {
        if (false === json_validate($value)) {
            throw new InvalidArgumentException('Database value must be a json string.');
        }

        return json_decode($value, true, 512, JSON_THROW_ON_ERROR);
    }
}
